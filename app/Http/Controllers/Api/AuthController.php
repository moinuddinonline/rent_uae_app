<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Sends an OTP to the user's mobile number for authentication.
     *
     * Validates the incoming request to ensure required fields 'mobile_prefix' and 'mobile_number' are present and valid.
     * Checks if the provided OTP matches the one stored in the database and is within the valid time window.
     * If valid, verifies user status and generates a JWT token for authenticated users.
     * If the user does not exist, creates a new user and assigns a default role.
     * Returns appropriate JSON responses based on the validation and authentication results.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing 'mobile_prefix' and 'mobile_number'.
     * @return \Illuminate\Http\JsonResponse A JSON response with status, code, message, and relevant data.
     */
    public function getOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_prefix' => 'required|string|max:5',
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'validation_error',
                'code'    => 422,
                "message" => "Please add valid information",
                "data"    => $validator->errors(),
            ]);
        }
        // $code = mt_rand(1000, 9999);
        $code          = "1234";
        $mobile_prefix = $request->input('mobile_prefix', '+91');
        $mobile_number = $request->input('mobile_number');
        $otp           = UserOtp::firstOrNew([
            'mobile_prefix' => $mobile_prefix,
            'mobile'        => $mobile_number,
            'type'          => "mobile",
        ]);
        if ($otp->resend <= 2) {
            $otp->code   = $code;
            $otp->resend = ($otp->resend + 1);
            $otp->save();
            // $this->sendSMSWithValueFirst($code, $mobile_number);
            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                "message" => "Otp send please check your mobile.",
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
    }

    /**
     * Validate the OTP sent to the user's mobile number for authentication.
     *
     * Validates the request to ensure required fields 'mobile_number' and 'otp' are present and valid.
     * Checks if the provided OTP matches the one stored in the database and is within the valid time window.
     * If valid, verifies user status and generates a JWT token for authenticated users.
     * If the user does not exist, creates a new user and assigns a default role.
     * Returns appropriate JSON responses based on the validation and authentication results.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing 'mobile_number' and 'otp'.
     * @return \Illuminate\Http\JsonResponse A JSON response with status, code, message, and relevant data.
     */
    public function validateOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|digits:10',
            'otp'           => 'required|numeric',
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
            $user = User::where('mobile', $request->input('mobile_number'))
                ->first();
            if ($user) {
                if ($user->status == 1) {
                    $valid->delete();
                    try {
                        $customClaims = [
                            "application" => "Finigenie",
                            "email"       => $user->email ?? "Not exist",
                            "mobile"      => $user->mobile,
                        ];
                        $token = JWTAuth::customClaims($customClaims)->fromUser($user);
                    } catch (JWTException $e) {
                        return response()->json([
                            'status'  => 'error',
                            'code'    => 500,
                            "message" => "System Error Please contact admin",
                            "data"    => $e->getExpectedExceptionMessage(),
                        ]);
                    }
                    return response()->json([
                        'status' => 'success',
                        'code'   => 200,
                        "data"   => [
                            "user"         => $user,
                            'access_token' => $token,
                        ],
                    ]);
                } else {
                    $valid->delete();
                    return response()->json([
                        'status'  => 'error',
                        'code'    => 409,
                        "message" => "This User Account is Blocked. Please contact admin.",
                        "data"    => null,
                    ]);
                }
            } else {
                $user                  = new User();
                $user->mobile_prefix   = $valid->mobile_prefix;
                $user->mobile          = $request->input('mobile_number');
                $user->password        = bcrypt(Str::random(12));
                $user->remember_token  = Str::random(10);
                $user->mobile_verified = 1;
                if ($user->save()) {
                    $user->addRole("user");
                    try {
                        $customClaims = [
                            "application" => "Finigenie",
                            "email"       => $user->email ?? "Not exist",
                            "mobile"      => $user->mobile,
                        ];
                        $token = JWTAuth::customClaims($customClaims)->fromUser($user);
                    } catch (JWTException $e) {
                        return response()->json([
                            'status'  => 'error',
                            'code'    => 500,
                            "message" => "System Error Please contact admin",
                            "data"    => $e->getExpectedExceptionMessage(),
                        ]);
                    }
                    $user = User::where('mobile', $request->input('mobile_number'))
                        ->first();
                    return response()->json([
                        'status' => 'success',
                        'code'   => 200,
                        "data"   => [
                            "user"         => $user,
                            'access_token' => $token,
                        ],
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'code'    => 500,
                        "message" => "System Error Please contact admin",
                        "data"    => null,
                    ]);
                }
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

    /**
     * Invalidate the current user's JWT token and log them out.
     *
     * This method invalidates the JWT token of the authenticated user,
     * effectively logging them out of the application. It returns a JSON response
     * indicating the success of the operation.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the logout success.
     */
    public function logout()
    {
        $forever = false;
        JWTAuth::parseToken()->invalidate($forever);
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            "message" => "Successfully logged out.",
            "data"    => null,
        ]);
    }
}
