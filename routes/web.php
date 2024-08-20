<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('create-user', [AdminController::class, 'createUser'])->name('createUser') ; 

Route::post('store-user', [AdminController::class, 'store'])->name('storeUser') ;

Route::get('account-activation', [AdminController::class, 'showAccountActivation'])->name('accountActivation') ;

Route::post('store-activated-user', [AdminController::class, 'validateAndSaveUser'])->name('storeActivatedUser') ;
