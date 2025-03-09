<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);
        $data    = Permission::orderBy('updated_at', 'DESC')
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('display_name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('description', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->paginate(15);
        return view('permission.list', compact('data', 'request'));
    }

    public function create()
    {
        return view('permission.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'permission_type' => 'required',
        ];
        if ($request->permission_type == "basic") {
            $rules['display_name'] = 'required';
            $rules['description']  = 'required';
        } else {
            $rules['resource']      = 'required';
            $rules['curd_selected'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        if ($request->permission_type == 'basic') {
            $permission               = new Permission();
            $permission->display_name = $request->input('display_name');
            $permission->name         = Str::slug($request->input('display_name'), '_');
            $permission->description  = $request->input('description', null);
            if ($permission->save()) {
                return response()->json([
                    'data' => [
                        "status"  => 'success',
                        "message" => "Permission has been created successfully.",
                    ],
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        "status"  => 'error',
                        "message" => "Sorry a problem has occurred.",
                    ],
                ], 200);
            }
        } else {
            foreach ($request->curd_selected as $x) {
                $display_name             = ucfirst($request->resource) . ' ' . ucfirst($x);
                $name                     = strtolower(Str::slug($request->resource, '_')) . '_' . strtolower($x);
                $description              = "Allows a user to " . strtolower($x) . ' a ' . ucwords($request->resource);
                $permission               = new Permission();
                $permission->display_name = $display_name;
                $permission->name         = $name;
                $permission->description  = $description;
                $permission->save();
            }
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Permission has been created successfully.",
                ],
            ], 200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::where('id', $id)->firstOrFail();
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required|string|unique:permissions,display_name,' . $id,
            'description'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $permission               = Permission::findOrFail($id);
        $permission->display_name = $request->input('display_name', null);
        $permission->name         = Str::slug($request->input('display_name'), '_');
        $permission->description  = $request->input('description', null);
        $permission->updated_at   = Carbon::now()->toDateTimeString();
        if ($permission->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Permission has been updated successfully.",
                ],
            ], 200);

        } else {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Sorry a problem has occurred.",
                ],
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $res        = $permission->delete();
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "Permission " . $permission->display_name . " has been Removed",
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
