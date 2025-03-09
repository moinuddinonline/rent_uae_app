<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
     /**
     * Retrieve and display a paginated list of roles.
     * 
     * Filters roles based on a keyword if provided. The keyword search is performed on the name, description and portal fields.
     * The results are ordered by the most recently updated and include the permissions for each role.
     * 
     * @param Request $request The current request instance, containing the optional keyword parameter.
     * @return \Illuminate\View\View The view displaying the list of filtered roles.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);
        $data    = Role::orderBy('updated_at', 'ASC')
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('description', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('portal', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->with('permissions')
            ->paginate(15);
        return view('role.list', compact('data', 'request'));
    }

    /**
     * Create a new role
     * 
     * Show the form for creating a new role.
     * 
     * @return \Illuminate\View\View The view displaying the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('role.add', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     * 
     * Validates the incoming request to ensure required fields are present and unique constraints are met.
     * If validation passes, a new role is created, associated permissions are synced, and a success response is returned.
     * If validation fails or an error occurs during saving, an error response with appropriate messages is returned.
     *
     * @param \Illuminate\Http\Request $request The request containing role details.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required|string|unique:roles,display_name',
            'description'  => 'nullable',
            'permissions'  => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $role               = new Role();
        $role->display_name = $request->input('display_name');
        $role->name         = Str::slug($request->input('display_name'), '_');
        $role->description  = $request->input('description', null);
        $res                = $role->save();
        $role->syncPermissions($request->permissions);
        if ($res) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Role has been created successfully!",
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
     * Display the specified resource for editing.
     *
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id)
    {
        $role        = Role::with('permissions')->findOrFail($role_id);
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('role.edit', compact('role', 'permissions'));
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
            'display_name' => 'required|string|unique:roles,display_name,' . $id,
            'description'  => 'nullable',
            'permissions'  => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $role               = Role::findOrFail($id);
        $role->display_name = $request->input('display_name');
        $role->name         = Str::slug($request->input('display_name'), '_');
        $role->description  = $request->input('description', null);
        $role->updated_at   = Carbon::now()->toDateTimeString();
        $res                = $role->save();
        $role->syncPermissions($request->permissions);
        if ($res) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Role has been updated successfully!",
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
        $role = Role::findOrFail($id);
        $res  = $role->delete();
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "Role " . ucwords(str_replace('-', ' ', $role->name)) . " has been Removed",
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
