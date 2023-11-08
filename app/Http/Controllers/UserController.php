<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    function LoginPage(): View {
        return view('pages.auth.login-page');
    }
    function RegistrationPage(): View {
        return view('pages.auth.registration-page');
    }
    function SendOTPCodePage(): View {
        return view('pages.auth.send-otp-page');
    }
    function VerifyOtpPage(): View {
        return view('pages.auth.verify-otp-page');
    }
    function ResetPasswordPage(): View {
        return view('pages.auth.reset-pass-page');
    }
    function dashboardPage(): View {
        return view('pages.dashboard.dashboard-page');
    }

    function UserRegistration(Request $request) {
        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName'  => $request->input('lastName'),
                'email'     => $request->input('email'),
                'mobile'    => $request->input('mobile'),
                'password'  => $request->input('password'),
            ]);
            return response()->json([
                'status'  => 'success',
                'message' => 'User Registration Successfully',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'failed',
                'message' => 'User Registration Failed',
                //'message' => $e->getMessage(),
            ], 200);
        }

    }
    function UserLogin(Request $request) {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();

        if ($count == 1) {

            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status'  => 'success',
                'message' => 'User Login Successfully',
                //'token'   => $token,
            ], 200)->cookie('token', $token, 60 * 24 * 30);

        } else {
            return response()->json([
                'status'  => 'Failed',
                'message' => 'User Login Failed',
            ], 401);
        }
    }
    function SendOTPCode(Request $request) {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', "=", $email)->count();
        if ($count == 1) {

            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', "=", $email)->update(['otp' => $otp]);

            return response()->json([
                'status'  => 'success',
                'message' => 'OTP Code Send',
            ], 200);

        } else {
            return response()->json([
                'status'  => 'Failed',
                'message' => 'unauthorized',
            ], 200);
        }
    }
    function VerifyOtp(Request $request) {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();
        if ($count == 1) {
            //Database OTP Update
            User::where('email', '=', $email)->update(['otp' => '0']);
            //Pass Reset Token Issue
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'statis'  => 'success',
                'message' => 'OTP Verification Successfully',
                'token'   => $token,
            ], 200);

        } else {
            return response()->json([
                'status'  => 'Failed',
                'message' => 'unauthorized',
            ], 200);
        }
    }
    function ResetPassword(Request $request) {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status'  => 'success',
                'message' => 'Request Successfully',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'Failed',
                'message' => 'Something Went Wrong',
            ], 401);
        }

    }
}
