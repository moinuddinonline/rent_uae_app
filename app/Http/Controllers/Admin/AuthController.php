<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

     /**
     * Handles the login process for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Auth\Guard $guard
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request, Guard $guard)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        } else {
            $remember    = $request->has('remember') ? true : false;
            $credentials = array(
                'email'    => $request->input('email'),
                'password' => $request->input('password'),
                'status'   => true,
            );
            if (Auth::attempt($credentials, $remember)) {
                return response()->json([
                    'data' => [
                        "status"  => 'success',
                        "message" => "Login success",
                    ],
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        "status"  => 'error',
                        "message" => "Please insert a valid credential.",
                    ],
                ], 200);
            }
        }
    }

    /**
     * Log the user out of the application.
     *
     * This method invalidates the user's session and redirects them
     * to the login page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Auth\Guard $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
