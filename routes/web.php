<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
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
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/invoicePage', [InvoiceController::class, 'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage', [InvoiceController::class, 'SalePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/reportPage', [ReportController::class, 'ReportPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'userProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'updateProfile'])->middleware([TokenVerificationMiddleware::class]);

//Category Api

Route::post('/create-category', [CategoryController::class, 'categoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-category', [CategoryController::class, 'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-category', [CategoryController::class, 'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-category', [CategoryController::class, 'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-by-id', [CategoryController::class, 'CategoryByID'])->middleware(TokenVerificationMiddleware::class);

//Customer Api

Route::post('/create-customer', [CustomerController::class, 'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-customer', [CustomerController::class, 'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-customer', [CustomerController::class, 'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-customer', [CustomerController::class, 'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerByID'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerByID'])->middleware(TokenVerificationMiddleware::class);

//Product Api
Route::post('/create-product', [ProductController::class, 'CreateProduct'])->middleware(TokenVerificationMiddleware::class);
Route::post('/delete-product', [ProductController::class, 'DeleteProduct'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-by-id', [ProductController::class, 'ProductByID'])->middleware(TokenVerificationMiddleware::class);
Route::get('/list-product', [ProductController::class, 'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-product', [ProductController::class, 'ProductUpdate'])->middleware(TokenVerificationMiddleware::class);

//Invoice
Route::post('/invoice-create', [InvoiceController::class, 'invoiceCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/invoice-select', [InvoiceController::class, 'invoiceSelect'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-details', [InvoiceController::class, 'InvoiceDetails'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-delete', [InvoiceController::class, 'invoiceDelete'])->middleware(TokenVerificationMiddleware::class);

Route::get('/summary', [DashboardController::class, 'Summary'])->middleware(TokenVerificationMiddleware::class);

Route::get('/sales-report/{FormDate}/{ToDate}', [ReportController::class, 'SalesReport'])->middleware(TokenVerificationMiddleware::class);