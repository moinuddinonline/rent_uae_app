<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class RentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);

        $data = Rent::with('vendor','user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('amount', 'LIKE', "%{$keyword}%")
                    ->orWhere('payment_status', 'LIKE', "%{$keyword}%");
            })->paginate(10);

        // return response()->json($data);
        return view('rents.list', compact('data'));
    }



    public function rentView($rent_id){

        $data = Rent::where('id', $rent_id)->with('user','vendor','vendor.rentType')->firstOrFail();
        // return response()->json($data);
        return view('rents.edit', compact('data'));

    }


    public function updateRent(Request $request, $rent_id){
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        


        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'status'  => 'validation_error',
                    'message' => $validator->errors(),
                ],
            ], 200);
        }


        $rent = Rent::where('id',$rent_id)->firstOrFail();
        $rent->payment_status=$request->input('status');
        if ($request->file('image') && $request->file('image')->isValid()) {
            if ($rent->payment_image && Storage::exists($rent->payment_image)) {
                Storage::delete($rent->payment_image);
            }
            $file            = $request->file('image');
            $file_name       = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file_path       = $file->storeAs('public', $file_name, 'local');
            $rent->payment_image = $file_path;
        }

        if ($rent->save()) {
            return response()->json([
                'data' => [
                    'status'  => 'success',
                    'message' => 'Rent updated successfully.',
                ],
            ], 200);
        }
        return response()->json([
            'data' => [
                'status'  => 'error',
                'message' => 'Failed to update Rent.',
            ],
        ], 200);
    }




    public function exportRent(Request $request)
    {
        $from_date = $request->input('from_date', null);
        $to_date = $request->input('to_date', null);
        if ($to_date) {
            $to_date = Carbon::createFromFormat('Y-m-d', $to_date)->addDay()->startOfDay();
        }
        $data = Rent::orderBy('created_at', 'DESC')
            ->with('vendor', 'user')
            ->where(function ($q) use ($from_date, $to_date) {
                if ($from_date && $to_date) {
                    $q->whereBetween('created_at', [$from_date, $to_date]);
                }
                if ($from_date && $to_date === null) {
                    $q->whereDate('created_at', $from_date);
                }
            })
            ->get();

        if ($data->count() <= 0) {
            return Redirect::back()->withErrors(['msg' => 'Did Not Found Any Rent with selected Date']);
        }

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=rent.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $columns = array(
            "User Name",
            "User Mobile",
            "User Email",
            "User Image",
            "User Status",
            "Payment Title",
            "Payment Status",
            "Payment Amount",
            "Payment Image",
            "Payment Date",
            "Vendor Name",
            "Vendor Mobile",
            "Vendor Email",
            "User Id"
        );
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $i) {
                $status = $i->user->status == 1 ? 'Active' : 'Blocked' ?? 'NA';
                $usermobile=$i->user->mobile_prefix . "-" . $i->user->mobile ?? 'NA';
                fputcsv($file, [
                    $i->user->name ?? 'NA',
                    $usermobile,
                    $i->user->email ?? 'NA',
                    $i->user->image ?? 'NA',
                    $status,
                    $i->payment_title ?? 'NA',
                    $i->payment_status ?? 'NA',
                    $i->amount ?? 'NA',
                    $i->payment_image ?? 'NA',
                    $i->payment_date ?? 'NA',
                    $i->vendor->vendor_name ?? 'NA',
                    $i->vendor->mobile ?? 'NA',
                    $i->vendor->email ?? 'NA',
                    $i->user->username ?? 'NA',
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);

    }





}
