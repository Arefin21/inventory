<?php

use App\Http\Controllers\CategoryController;
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

//User Logout
Route::get('/logout', [UserController::class, 'UserLogout']);

//Page Route
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/sendOtp', [UserController::class, 'SendOTPCodePage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [UserController::class, 'dashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'profilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'userProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'updateProfile'])->middleware([TokenVerificationMiddleware::class]);

//Category Api

Route::post('/create-category', [CategoryController::class, 'categoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-category', [CategoryController::class, 'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-category', [CategoryController::class, 'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-category', [CategoryController::class, 'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);