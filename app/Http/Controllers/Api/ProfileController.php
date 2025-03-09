<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Update the authenticated user's profile information.
     *
     * Validates the incoming request for required fields 'name' and 'email'.
     * If validation fails, returns a JSON response with validation error messages.
     * If validation passes, updates the user's profile information.
     * If updating is successful, sends an OTP to the user's email and returns a JSON response with success message.
     * If updating fails, returns a JSON response with error message.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse A JSON response with status and message.
     */
    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }
        $user        = User::find(auth()->user()->id);
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($user->save()) {
            //Send OTP to Given Email
            $code = "1234";
            $otp  = UserOtp::firstOrNew([
                'email' => $user->email,
                'type'  => "email",
            ]);
            $otp->code   = $code;
            $otp->resend = ($otp->resend + 1);
            $otp->save();
            $user = User::find(auth()->user()->id);
            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                "message" => "Profile Updated Successfully, Please check your email for OTP",
                "data"    => $user,
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

    /**
     * Sends an OTP to the user's email for verification.
     *
     * Validates the incoming request for required field 'email'.
     * Retrieves the user by the given email, generates an OTP, and
     * sends it to the user via email. If the user does not exist,
     * or if the validation fails, appropriate error responses are returned.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse A JSON response with status and message.
     */
    public function getEmailOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $code = "1234";
            $otp  = UserOtp::firstOrNew([
                'email' => $user->email,
                'type'  => "email",
            ]);
            if ($otp->resend <= 2) {
                $otp->code   = $code;
                $otp->resend = ($otp->resend + 1);
                $otp->save();
                return response()->json([
                    'status'  => 'success',
                    'code'    => 200,
                    "message" => "Please check your email for OTP",
                    "data"    => null,
                ]);
            } else {
                $otp->delete();
                return response()->json([
                    'status'  => 'error',
                    'code'    => 400,
                    "message" => "Max request limit reached please try after some time.",
                    "data"    => null,
                ]);
            }
        } else {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                "message" => "User not found",
                "data"    => null,
            ]);
        }
    }

    /**
     * Verify the OTP sent to the user's email to verify the email.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmailOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp'   => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }
        $code  = $request->input('otp');
        $valid = UserOtp::where('mobile', $request->input('mobile_number'))
            ->where('updated_at', '>', Carbon::now()->subMinutes(10))
            ->where('code', $code)
            ->first();
        if ($valid) {
            $user = User::where('email', $request->email)
                ->where('id', Auth::user()->id)
                ->first();
            if ($user) {
                $user->email_verified = 1;
                $user->save();
                $valid->delete();
                $user = User::find(auth()->user()->id);
                return response()->json([
                    'status'  => 'success',
                    'code'    => 200,
                    "message" => "Email Verified Successfully",
                    "data"    => $user,
                ]);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'code'    => 500,
                    "message" => "User not found",
                    "data"    => null,
                ]);
            }
        } else {
            return response()->json([
                'status'  => 'error',
                'code'    => 400,
                "message" => "You have inserted wrong OTP.",
                "data"    => null,
            ]);
        }
    }
}
