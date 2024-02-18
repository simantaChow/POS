<?php

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
Route::get('/resetpass', [UserController::class, 'resetPassPage'])->name('resetpass');
Route::get('/sendotp', [UserController::class, 'sendOtp'])->name('sendotp');
Route::get('/verifyotp', [UserController::class, 'verifyOtppage'])->name('verifyotp');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

//api
Route::post('/user-registration', [UserController::class, 'UserRegistration'])->name('UserRegistration');
Route::post('/user-login', [UserController::class, 'UserLogin'])->name('UserLogin');
Route::post('/send-otp', [UserController::class, 'SendOTPCode'])->name('SendOtp');
Route::post('/verify-otp', [UserController::class, 'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-pass', [UserController::class, 'ResetPass'])->name('ResetPass')->middleware([TokenVerifycationMiddleware::class]);
