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
Route::get('/resetpass', [UserController::class, 'resetPassPage'])->name('resetpass')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/sendotp', [UserController::class, 'sendOtp'])->name('sendotp');
Route::get('/verifyotp', [UserController::class, 'verifyOtppage'])->name('verifyotp');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'profilePage'])->name('profile')->middleware([TokenVerifycationMiddleware::class]);


//api
Route::post('/user-registration', [UserController::class, 'UserRegistration'])->name('UserRegistration');
Route::post('/user-login', [UserController::class, 'UserLogin'])->name('UserLogin');
Route::post('/send-otp', [UserController::class, 'SendOTPCode'])->name('SendOtp');
Route::post('/verify-otp', [UserController::class, 'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-pass', [UserController::class, 'ResetPassword'])->name('ResetPassword')->middleware([TokenVerifycationMiddleware::class]);
Route::get('/userprofile', [UserController::class, 'userprofile'])->name('userprofile')->middleware([TokenVerifycationMiddleware::class]);
Route::post('/updateprofile', [UserController::class, 'UpdateProfile'])->name('updateprofile')->middleware([TokenVerifycationMiddleware::class]);
