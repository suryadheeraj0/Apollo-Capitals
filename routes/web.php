<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
;


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


//route for welcome page which is not protectd 

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//dashboard 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Routes which are protected by auth middleware 

Route::middleware(['auth', ])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth'])->group(function () {
Route::get('/otp/verify', [OtpController::class, 'show'])->name('otp.verify');
Route::post('/otp/verify', [OtpController::class, 'verify']);

Route::post('/otp/request', [OtpController::class, 'requestNewOtp'])
    ->middleware('throttle:otp-request')
    ->name('otp.request');

Route::post('/profile/enable-mfa', [ProfileController::class, 'enableMfa'])->name('profile.enableMfa');
Route::post('/profile/disable-mfa', [ProfileController::class, 'disableMfa'])->name('profile.disableMfa');
    

});

// routes/web.php
//Route::post('/otp/request', [OtpController::class, 'requestNewOtp'])->name('otp.request');
// routes/web.php
use Illuminate\Support\Facades\RateLimiter;



require __DIR__.'/auth.php';

//user management routes

Route::get('create-user', [AdminController::class, 'createUser'])->name('createUser') ; 

Route::post('store-user', [AdminController::class, 'store'])->name('storeUser') ;

Route::get('account-activation', [AdminController::class, 'showAccountActivation'])->name('accountActivation') ;

Route::post('store-activated-user', [AdminController::class, 'validateAndSaveUser'])->name('storeActivatedUser') ;


//surya routes

Route::get('admi',[AdminController::class,'usersDataWithAccess'])->name('admi');

Route::resource('admin', AdminRolesController::class);




