<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\TokenVerifycationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//web
Route::view('/', 'pages.home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('signup');
Route::get('/resetpass', [UserController::class, 'resetPassPage'])->name('resetpass')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/sendotp', [UserController::class, 'sendOtp'])->name('sendotp');
Route::get('/verifyotp', [UserController::class, 'verifyOtppage'])->name('verifyotp');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'profilePage'])->name('profile')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/category', [CategoryController::class, 'CategoryPage'])->name('category')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/customers', [CustomerController::class, 'CustomerPage'])->name('customerpage')->middleware([TokenVerifycationMiddleware::class]);


//User Related api
Route::post('/user-registration', [UserController::class, 'UserRegistration'])->name('UserRegistration');
Route::post('/user-login', [UserController::class, 'UserLogin'])->name('UserLogin');
Route::post('/send-otp', [UserController::class, 'SendOTPCode'])->name('SendOtp');
Route::post('/verify-otp', [UserController::class, 'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-pass', [UserController::class, 'ResetPassword'])->name('ResetPassword')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/userprofile', [UserController::class, 'userprofile'])->name('userprofile')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/customer', [CustomerController::class, 'CustomerPage'])->name('customer')->middleware([TokenVerifycationMiddleware::class]);


//Category Related api
Route::post('/categorycreate', [CategoryController::class, 'CategoryCreate'])->name('categorycreate')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/categorylist', [CategoryController::class, 'CategoryList'])->name('categorylist')->middleware([TokenVerifycationMiddleware::class]);
Route::post('/categoryupdate', [CategoryController::class, 'CategoryUpdate'])->name('categoryupdate')->middleware([TokenVerifycationMiddleware::class]);
Route::post('/categorydelete', [CategoryController::class, 'CategoryDelete'])->name('categorydelete')->middleware([TokenVerifycationMiddleware::class]);

//Customers Related api
Route::post('/createcustomer', [CustomerController::class, 'CustomerCreate'])->name('createcustomer')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/customerlist', [CustomerController::class, 'CustomerList'])->name('customerlist')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/customerbyid', [CustomerController::class, 'CustomerByID'])->name('customerbyid')->middleware([TokenVerifycationMiddleware::class]);
Route::post('/customerupdate', [CustomerController::class, 'CustomerUpdate'])->name('customerupdate')->middleware([TokenVerifycationMiddleware::class]);
Route::post('/customerdelete', [CustomerController::class, 'CustomerDelete'])->name('customerdelete')->middleware([TokenVerifycationMiddleware::class]);
