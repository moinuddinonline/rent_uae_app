<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentType;
use Illuminate\Http\Request;
use App\Models\RentVendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RentVendorController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);

        $data = RentVendor::with('user', 'RentType')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('vendor_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('mobile', 'LIKE', "%{$keyword}%")
                    ->orWhere('iban_number', 'LIKE', "%{$keyword}%");
            })
            ->paginate(10);
        return view('rent_vendors.list', compact('data'));

    }




}
