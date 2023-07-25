<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Profile\ProfileController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Payment\PaymentQRController;
use App\Http\Controllers\User\Payment\PassbookController;
use App\Http\Controllers\User\Payment\FundController;
use App\Http\Controllers\User\Payment\TransactionController;
use App\Http\Controllers\User\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// signup
Route::get('/signup',[RegisterController::class,'index'])->name('signup.index');
Route::post('/signup/store',[RegisterController::class,'store'])->name('signup.store');
Route::post('/fetch-states',[RegisterController::class,'fetchState'])->name('fetchState');
Route::get('/user/activation/{id}',[RegisterController::class,'activation'])->name('user.activation');
//login
Route::get('/login',[LoginController::class,'showLoginForm'])->name('user.login');
Route::post('/login',[LoginController::class,'login'])->name('user.login');
Route::post('/logout',[LoginController::class,'logout'])->name('user.logout');

Route::get('/password/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('/password/email',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset',[ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset',[ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['prefix' => 'user','middleware' => 'auth'], function () {
    //dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('user.dashboard.index');
    
    //My profile
    
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update/{id}',[ProfileController::class,'update'])->name('profile.update');
    Route::post('/change/password/{id}',[ProfileController::class,'changePassword'])->name('change.password');
    //Payment QR
    Route::get('payment-qr', [PaymentQRController::class,'index'])->name('user.payment-qr.index');
    Route::get('payment-qr/{id}', [PaymentQRController::class,'show'])->name('user.payment-qr.show');
    //Add Fund
    Route::get('funds', [FundController::class,'index'])->name('user.funds.index');
    Route::get('fund/create', [FundController::class,'create'])->name('user.funds.create');
    Route::post('fund/store', [FundController::class,'store'])->name('user.funds.store');
    //passbook
    Route::get('passbooks', [PassbookController::class,'index'])->name('user.passbooks.index');
    Route::get('passbook/{id}', [PassbookController::class,'show'])->name('user.passbook.show');
    
    
});
Route::group(['prefix' => 'user/payment','middleware' => 'auth'], function () {
    //payment request manage
    Route::get('pending/request', [TransactionController::class,'index'])->name('user.payment.pending.request.index');
    Route::get('approved', [TransactionController::class,'approved'])->name('user.payment.approved');
    Route::get('approved/{id}', [TransactionController::class,'approved_show'])->name('user.payment.approved.show');
    Route::get('canceled', [TransactionController::class,'canceled'])->name('user.payment.canceled');
    Route::get('canceled/{id}', [TransactionController::class,'canceled_show'])->name('user.payment.canceled.show');
    Route::get('request/create', [TransactionController::class,'create'])->name('user.payment.request.create');
    Route::post('request/store', [TransactionController::class,'store'])->name('user.payment.request.store');
    Route::get('request/{id}', [TransactionController::class,'show'])->name('user.payment.request.show');
});
Route::group(['middleware' => 'auth'], function () {
    //Payment QR
    Route::get('users', [UserController::class,'index'])->name('users.index');
    Route::get('user/{id}', [UserController::class,'show'])->name('user.show');

});

