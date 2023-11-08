<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

//Api Route
Route::post('/UserRegistration', [UserController::class, 'UserRegistration']);
Route::post('/UserLogin', [UserController::class, 'UserLogin']);
Route::post('/SendOTPCode', [UserController::class, 'SendOTPCode']);
Route::post('/VerifyOtp', [UserController::class, 'VerifyOtp']);

Route::post('/ResetPassword', [UserController::class, 'ResetPassword'])
    ->middleware([TokenVerificationMiddleware::class]);

//Page Route
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/sendOtp', [UserController::class, 'SendOTPCodePage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [UserController::class, 'dashboardPage']);