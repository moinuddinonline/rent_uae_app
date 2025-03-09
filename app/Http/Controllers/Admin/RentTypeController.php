<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RentTypeController extends Controller
{
    public function index(Request $request, $type = 'active')
    {
        $keyword = $request->input('keyword', null);
        $data = RentType::orderBy('updated_at', 'desc')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%");
            })
            ->where(function ($q) use ($type) {
                if ($type === 'active') {
                    $q->where('status', 1);
                }
                if ($type === 'archived') {
                    $q->where('status', 0);
                }
            })
            ->paginate(15);


        $data->getCollection()->transform(function ($item) {
            if (in_array($item->name, ['Home Rental', 'Home Rental', 'Service Apartments & Short-Term Rentals', 'Warehouse & Storage Facilities'])) {
                $item->category = 'Property';
            } elseif (in_array($item->name, ['Car Rental', 'Yachts on Rent', 'Parking Rental', 'Bike and Scooter Rentals'])) {
                $item->category = 'Transport';
            } elseif (in_array($item->name, ['Electronics on Rent', 'Furniture on Rent', 'Medical Equipment on Rentals', 'Education Fees'])) {
                $item->category = 'HouseHold';
            } else {
                $item->category = 'No Category';
            }

            return $item;
        });
        return view('rent_types.list', compact('data', 'request'));
    }

    public function create()
    {
        return view('rent_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|unique:rent_types,name',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'status' => 'validation_error',
                    'message' => $validator->errors(),
                ],
            ], 200);
        }

        $rentType = new RentType();
        $rentType->name = $request->input('name');
        $rentType->slug = Str::slug($request->input('name'));
        $rentType->description = $request->input('description');
        if ($request->file('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('public', $file_name, 'local');
            $rentType->image = $file_path;
        }
        if ($rentType->save()) {
            return response()->json([
                'data' => [
                    'status' => 'success',
                    'message' => 'Rent Type created successfully.',
                ],
            ], 200);
        }

        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Failed to create Rent Type.',
            ],
        ], 200);
    }
    public function show($id)
    {
        $rentType = RentType::findOrFail($id); // Fetch rent type or fail
        return view('rent_types.show', compact('rentType'));
    }

    public function edit($id)
    {
        $rentType = RentType::findOrFail($id);
        return view('rent_types.edit', compact('rentType'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|unique:rent_types,name,' . $id,
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'status' => 'validation_error',
                    'message' => $validator->errors(),
                ],
            ], 200);
        }

        $rentType = RentType::findOrFail($id);
        $rentType->name = $request->input('name');
        $rentType->slug = Str::slug($request->input('name'));
        $rentType->description = $request->input('description');
        if ($request->file('image') && $request->file('image')->isValid()) {
            if ($rentType->image && Storage::exists($rentType->image)) {
                Storage::delete($rentType->image);
            }
            $file = $request->file('image');
            $file_name = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('public', $file_name, 'local');
            $rentType->image = $file_path;
        }
        if ($rentType->save()) {
            return response()->json([
                'data' => [
                    'status' => 'success',
                    'message' => 'Rent Type updated successfully.',
                ],
            ], 200);
        }
        return response()->json([
            'data' => [
                'status' => 'error',
                'message' => 'Failed to update Rent Type.',
            ],
        ], 200);
    }

    public function destroy($id)
    {
        $rentType = RentType::findOrFail($id);
        if ($rentType->image && Storage::exists($rentType->image)) {
            Storage::delete($rentType->image);
        }
        if ($rentType->delete()) {
            return response()->json([
                'success' => [
                    'message' => 'Rent Type deleted successfully.',
                ],
            ], 200);
        }
        return response()->json([
            'error' => [
                'message' => 'Failed to delete Rent Type.',
            ],
        ], 200);
    }

    public function archive($id)
    {
        $res = RentType::where('id', $id)
            ->update([
                'status' => 0,
            ]);
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "Rent Type has been Updated",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Record not Found",
                ],
            ], 200);
        }

    }

    public function restore($id)
    {
        $res = RentType::where('id', $id)
            ->update([
                'status' => 1,
            ]);
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "Rent Type has been Updated",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Record not Found",
                ],
            ], 200);
        }
    }

}
