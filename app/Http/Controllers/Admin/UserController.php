<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = 'active')
    {
        $keyword = $request->input('keyword', null);
        $data    = User::orderBy('name', 'ASC')
            ->where(function ($q) use ($type) {
                if ($type === 'active') {
                    $q->where('status', 1);
                }
                if ($type === 'archived') {
                    $q->where('status', 0);
                }
            })
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('mobile', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->with('roles')
            ->paginate(10);
        return view('user.list', compact('data', 'request'));
    }

    /**
     * Show the form for creating a new user.
     *
     * Retrieves the roles associated with the ADMIN_PORTAL and passes them to the view.
     *
     * @return \Illuminate\View\View The view for adding a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.add', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * Validates the incoming request for required fields 'name', 'email', 'mobile', 'password', 'password_confirmation' and 'roles'.
     * If validation fails, returns a JSON response with validation error messages.
     * If validation passes, creates a new User instance and saves it to the database.
     * If User instance is saved successfully, syncs the roles and returns a JSON response with success message.
     * If User instance is not saved successfully, returns a JSON response with error message.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse A JSON response with status and message.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string',
            'email'                 => 'required|email|unique:users,email',
            'mobile'                => 'required|unique:users,mobile',
            'mobile_prefix'         => 'nullable',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'roles'                 => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user                  = new User();
        $user->name            = $request->input('name');
        $user->email           = $request->input('email');
        $user->mobile_prefix   = $request->input('mobile_prefix') ?? '+91';
        $user->mobile          = $request->input('mobile');
        $user->password        = bcrypt($request->input('password'));
        $user->remember_token  = Str::random(10);
        $user->mobile_verified = 1;
        $user->email_verified  = 1;
        if ($user->save()) {
            $roles = $request->roles;
            $user->syncRoles($roles);
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "User has been created successfully.",
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
     * Show the form for editing the specified user.
     *
     * Retrieves the user by the given ID along with the roles associated with the ADMIN_PORTAL.
     * Passes the user and roles data to the view for editing the user details.
     *
     * @param int $id The ID of the user to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View The view for editing the user.
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user  = User::where('id', $id)->first();
        return view('user.edit', compact('roles', 'user'));

    }

    /**
     * Update the specified user in storage.
     *
     * Validates the incoming request for required fields 'name', 'email', 
     * 'mobile', 'mobile_prefix', 'password', 'password_confirmation', and 'roles'.
     * Retrieves the user by the given ID, updates the user details if they exist,
     * and returns a JSON response indicating success. If the user does not exist,
     * or if the validation fails, appropriate error responses are returned.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @param int $id The ID of the user to update.
     * @return \Illuminate\Http\JsonResponse A JSON response with status and message.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string',
            'email'                 => 'required|email|unique:users,email,' . $id,
            'mobile'                => 'required|unique:users,mobile,' . $id,
            'mobile_prefix'         => 'nullable',
            'password'              => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'roles'                 => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user                = User::findOrFail($id);
        $user->name          = $request->input('name');
        $user->email         = $request->input('email');
        $user->mobile_prefix = $request->input('mobile_prefix') ?? '+91';
        $user->mobile        = $request->input('mobile');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->updated_at = Carbon::now()->toDateTimeString();
        if ($user->save()) {
            $roles = $request->roles;
            $user->syncRoles($roles);
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Admin has been updated successfully.",
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
     * Get the specified user.
     *
     * Retrieves the user with the given ID along with their roles.
     * If the user is not found, returns null.
     *
     * @param int $id The ID of the user to retrieve.
     * @return \App\Models\User The user with roles.
     */
    public function show($id)
    {
        return $user = User::where('id', $id)
            ->with('roles')
            ->first();
    }

    /**
     * Archive the specified user.
     *
     * Sets the user's status to inactive (0) based on the given ID.
     * If successful, returns a JSON response indicating the user has been updated.
     * If the user is not found, returns a JSON response indicating an error.
     *
     * @param int $id The ID of the user to archive.
     * @return \Illuminate\Http\JsonResponse A JSON response with status and message.
     */
    public function archive($id)
    {
        $res = User::where('id', $id)
            ->update([
                'status' => 0,
            ]);
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "User has been Updated",
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

    /**
     * Restore the user by setting their status to active.
     *
     * This function updates the status of a user record with the given ID to 'active' (status = 1).
     * If the update is successful, a JSON response with a success message is returned.
     * If the user record is not found, a JSON response with an error message is returned.
     *
     * @param int $id The ID of the user to restore.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function restore($id)
    {
        $res = User::where('id', $id)
            ->update([
                'status' => 1,
            ]);
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "User has been Updated",
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
