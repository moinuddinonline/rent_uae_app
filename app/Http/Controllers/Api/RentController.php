<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\RentType;
use App\Models\RentVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
    /**
     * Get all rent types.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRentTypes(Request $request)
    {
        $keyword   = $request->get('keyword') ?? '';
        $rentTypes = RentType::orderBy('sort_order')
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                }
            })
            ->get();
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            "message" => "Success",
            "data"    => $rentTypes,
        ]);
    }

    public function rentPayments(Request $request)
    {
        $rents = Rent::where('user_id', Auth::user()->id)
            ->with(['vendor', 'user'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            "message" => "Success",
            "data"    => $rents,
        ]);
    }

    public function rentPaymentDetail($rent_id)
    {
        $rent = Rent::where('id', $rent_id)
            ->where('user_id', Auth::user()->id)
            ->with(['vendor', 'user'])
            ->first();
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            "message" => "Success",
            "data"    => $rent,
        ]);
    }

    public function createRent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rent_type_id'  => 'required|exists:rent_types,id',
            'vendor_name'   => 'required',
            'email'         => 'required',
            'mobile'        => 'required',
            'iban_number'   => 'required',
            'amount'        => 'required|numeric|min:1',
            'payment_title' => 'required',
            'payment_date'  => 'required|date|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }
        //now check if a RentVendor present with a combination of user_id, rent_type_id and iban_number
        try {
            $rentVendor = RentVendor::where('user_id', Auth::user()->id)
                ->where('rent_type_id', $request->rent_type_id)
                ->where('iban_number', $request->iban_number)
                ->first();
            if (!$rentVendor) {
                //create new vendor
                $rentVendor               = new RentVendor();
                $rentVendor->user_id      = Auth::user()->id;
                $rentVendor->rent_type_id = $request->rent_type_id;
                $rentVendor->vendor_name  = $request->vendor_name;
                $rentVendor->email        = $request->email;
                $rentVendor->mobile       = $request->mobile;
                $rentVendor->iban_number  = $request->iban_number;
                $rentVendor->save();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                "message" => "Something went wrong",
                "data"    => $th->getMessage(),
            ]);
        }
        // Create new rent
        $rent                 = new Rent();
        $rent->user_id        = Auth::user()->id;
        $rent->rent_vendor_id = $rentVendor->id;
        $rent->amount         = $request->amount;
        $rent->payment_title  = $request->payment_title;
        $rent->payment_date   = $request->payment_date;
        if ($rent->save()) {
            $data = Rent::where('id', $rent->id)
                ->with(['vendor', 'user'])
                ->first();
            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                "message" => "Success",
                "data"    => $data,
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                "message" => "Something went wrong",
                "data"    => [],
            ]);
        }
    }

    public function payRentByVendor(Request $request, $vendor_id)
    {
        $validator = Validator::make($request->all(), [
            'amount'        => 'required|numeric|min:1',
            'payment_title' => 'required',
            'payment_date'  => 'required|date|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }

        $rentVendor = RentVendor::where('id', $vendor_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$rentVendor) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => "No vendor found",
            ]);
        }
        $rent                 = new Rent();
        $rent->user_id        = Auth::user()->id;
        $rent->rent_vendor_id = $rentVendor->id;
        $rent->amount         = $request->amount;
        $rent->payment_title  = $request->payment_title;
        $rent->payment_date   = $request->payment_date;
        if ($rent->save()) {
            $data = Rent::where('id', $rent->id)
                ->with(['vendor', 'user'])
                ->first();
            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                "message" => "Success",
                "data"    => $data,
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                "message" => "Something went wrong",
                "data"    => null,
            ]);
        }
    }
}
