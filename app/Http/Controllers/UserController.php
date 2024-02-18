<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPmail;
use Exception;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller
{
    function login(): View
    {
        return view('pages.auth.login-page');
    }


    function UserRegistration(Request $request): JsonResponse
    {
        try {
            User::create([
                'firstname' => $request->input('firstname',),
                'lastname' => $request->input('lastname',),
                'email' => $request->input('email',),
                'mobile' => $request->input('mobile',),
                'password' => $request->input('password',),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'user registration successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ], 500);

        }


    }

    function UserLogin(Request $request): JsonResponse
    {
        $count = User::where('email', '=', $request->input('email'))->where('password', '=', $request->input('password'))->count();
        if ($count == 1) {
            //user login->JWT Token Issue
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Success',
                'token' => $token
            ], 200);

        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'User & Password Wrong'
            ], 500);
        }
    }

    function SendOTPCode(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();
        if ($count == 1) {
            //email to user
            Mail::to($email)->send(new OTPmail($otp));
            //insert OTP to database
            User::where('email', '=', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => '4 Digit OTP Send to your email',
            ], 200);
        } else return response()->json([
            'status' => 'fail',
            'message' => 'Email Not Matching'
        ], 500);

    }

    function VerifyOTP(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();
        if ($count == 1) {
            //Database OTP Update
            User::where('email', '=', $email)->update(['otp' => '0']);
            //Pass Reset Token Issue
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verify Successfully',
                'token' => $token
            ], 200);

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }

    function ResetPass(Request $request): JsonResponse
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successfully',
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went wrong',
            ], 200);
        }
    }

}





