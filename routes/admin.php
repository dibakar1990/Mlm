<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth
Route::match(['get', 'head'], 'login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::match(['get', 'head'], 'password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::match(['get', 'head'], 'password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    //notification
    Route::post('/nitification/mark-as-read','Notification\NotificationController@markNotification')->name('markNotification');

    Route::resource('/profile','ProfileController')->only('index','update');
    Route::get('/change-password','ProfileController@change_password')->name('change.password');
    Route::post('/update-password/{id}','ProfileController@update_password')->name('update.password');
    Route::resource('/settings','Setting\SettingController')->only('edit','update');
    //social link
    Route::resource('/social-links','Setting\SocialLinkController')->only('index','create','store','edit','update','destroy');
    Route::put('social-links/status/{id}', 'Setting\SocialLinkController@status')->name('social-links.status');
    Route::post('social-link/active/action', 'Setting\SocialLinkController@action')->name('social-link.active.action');
    //social link trashed
    Route::get('/social-link/trashed','Setting\TrashedController@index')->name('social-link.trashed.index');
    Route::post('social-link/trashed/action', 'Setting\TrashedController@action')->name('social-link.trashed.action');
    Route::get('social-link/trashed/restore/{id}', 'Setting\TrashedController@restore')->name('social-link.trashed.restore');
    Route::delete('social-link/trashed/destroy/{id}', 'Setting\TrashedController@destroy')->name('social-link.trashed.destroy');
    //email configuration
    Route::resource('/email-configurations','Setting\EmailConfigurationController')->only('edit','update');
    Route::resource('/roles', 'RoleController')->only('index','create','store','edit','update','destroy');
    //users
    Route::resource('/users','User\UserController')->only('index','show','destroy');
    Route::put('user/status/{id}', 'User\UserController@status')->name('users.status');
    Route::post('user/active/action', 'User\UserController@action')->name('users.active.action');
    Route::get('active/users', 'User\UserController@active')->name('active.users');
    Route::get('inactive/users', 'User\UserController@inactive')->name('inactive.users');
    Route::get('banned/users', 'User\UserController@banned')->name('banned.users');
    //user trashed
    Route::resource('/user/trashed','User\TrashedController')->only('index','destroy');
    Route::post('/user/trashed/action','User\TrashedController@action')->name('user.trashed.action');
    Route::get('/user/trashed/restore/{id}','User\TrashedController@restore')->name('user.trashed.restore');
    //payment qr
    Route::resource('/payment-qr','Payment\PaymentQRController')->only('index','create','store','edit','update','destroy');
    Route::put('payment-qr/status/{id}', 'Payment\PaymentQRController@status')->name('payment-qr.status');
    Route::post('payment-qr/active/action', 'Payment\PaymentQRController@action')->name('payment-qr.active.action');
    //payment qr trashed
    Route::get('/payment-qr/trashed','Payment\TrashedController@index')->name('payment-qr.trashed.index');
    Route::post('payment-qr/trashed/action', 'Payment\TrashedController@action')->name('payment-qr.trashed.action');
    Route::get('payment-qr/trashed/restore/{id}', 'Payment\TrashedController@restore')->name('payment-qr.trashed.restore');
    Route::delete('payment-qr/trashed/destroy/{id}', 'Payment\TrashedController@destroy')->name('payment-qr.trashed.destroy');
    //notice
    Route::resource('/notices','Notice\NoticeController');
    Route::put('notice/status/{id}', 'Notice\NoticeController@status')->name('notice.status');
    Route::put('notice/default/status/{id}', 'Notice\NoticeController@default_status')->name('notice.default.status');
    Route::post('notice/active/action', 'Notice\NoticeController@action')->name('notice.active.action');
     // notice trashed
     Route::get('/notice/trashed','Notice\TrashedController@index')->name('notice.trashed.index');
     Route::post('/notice/trashed/action','Notice\TrashedController@action')->name('notice.trashed.action');
     Route::get('/notice/trashed/restore/{id}','Notice\TrashedController@restore')->name('notice.trashed.restore');
     Route::delete('notice/trashed/destroy/{id}', 'Notice\TrashedController@destroy')->name('notice.trashed.destroy');
 
    //add fund 
    Route::resource('/funds','Payment\FundController')->only('index','create','store');
    //passbook
    Route::resource('/passbooks','Payment\PassbookController')->only('index','show');
    //global
    Route::resource('/globals','Global\GlobalController')->only('index','create','store','show','edit','update','destroy');
    Route::put('global/status/{id}', 'Global\GlobalController@status')->name('global.status');
    //level
    Route::resource('/levels','Bonus\LevelController')->only('index','create','store','edit','update','destroy');
    Route::put('level/status/{id}', 'Bonus\LevelController@status')->name('level.status');
    Route::post('level/active/action', 'Bonus\LevelController@action')->name('level.active.action');
    // level trashed
    Route::get('/level/trashed','Bonus\Level\TrashedController@index')->name('level.trashed.index');
    Route::post('/level/trashed/action','Bonus\Level\TrashedController@action')->name('level.trashed.action');
    Route::get('/level/trashed/restore/{id}','Bonus\Level\TrashedController@restore')->name('level.trashed.restore');
    Route::delete('level/trashed/destroy/{id}', 'Bonus\Level\TrashedController@destroy')->name('level.trashed.destroy');
});
Route::group(['prefix' => 'payment','middleware' => 'auth'], function () {
    //Payment Request Manage
    Route::resource('/request','Payment\TransactionController')->only('index','show');
    Route::put('request/approve/{id}', 'Payment\TransactionController@payment_request')->name('request.approve');
    Route::get('approved', 'Payment\TransactionController@approved')->name('payment.approved');
    Route::get('approved/{id}', 'Payment\TransactionController@approved_show')->name('payment.approved.show');
    Route::get('canceled', 'Payment\TransactionController@canceled')->name('payment.canceled');
    Route::get('canceled/{id}', 'Payment\TransactionController@canceled_show')->name('payment.canceled.show');
});
Route::group(['prefix' => 'global','middleware' => 'auth'], function () {
    
    //Plans
    Route::resource('/plans','Global\PlanController')->only('index','create','store','edit','update','destroy');
    Route::put('plan/status/{id}', 'Global\PlanController@status')->name('plan.status');
    Route::post('plan/active/action', 'Global\PlanController@action')->name('plan.active.action');
    // Plan trashed
    Route::get('/plan/trashed','Global\Plan\TrashedController@index')->name('plan.trashed.index');
    Route::post('/plan/trashed/action','Global\Plan\TrashedController@action')->name('plan.trashed.action');
    Route::get('/plan/trashed/restore/{id}','Global\Plan\TrashedController@restore')->name('plan.trashed.restore');
    Route::delete('plan/trashed/destroy/{id}', 'Global\Plan\TrashedController@destroy')->name('plan.trashed.destroy');
});
Route::group(['prefix' => 'level','middleware' => 'auth'], function () {
    
    //Bonus
    Route::resource('/bonus','Bonus\BonusController')->only('index','create','store','edit','update','destroy');
    Route::put('bonus/status/{id}', 'Bonus\BonusController@status')->name('bonus.status');
    Route::post('bonus/active/action', 'Bonus\BonusController@action')->name('bonus.active.action');
    // bonus trashed
    Route::get('/bonus/trashed','Bonus\TrashedController@index')->name('bonus.trashed.index');
    Route::post('/bonus/trashed/action','Bonus\TrashedController@action')->name('bonus.trashed.action');
    Route::get('/bonus/trashed/restore/{id}','Bonus\TrashedController@restore')->name('bonus.trashed.restore');
    Route::delete('bonus/trashed/destroy/{id}', 'Bonus\TrashedController@destroy')->name('bonus.trashed.destroy');
});

    //Rank and reward bonus
    Route::resource('/rewards','Reward\RewardController')->only('index','create','store','edit','update','destroy');
    Route::put('reward/status/{id}', 'Reward\RewardController@status')->name('reward.status');
    Route::post('reward/active/action', 'Reward\RewardController@action')->name('reward.active.action');
    // Rank and reward bonus trashed
    Route::get('/reward/trashed','Reward\TrashedController@index')->name('reward.trashed.index');
    Route::post('/reward/trashed/action','Reward\TrashedController@action')->name('reward.trashed.action');
    Route::get('/reward/trashed/restore/{id}','Reward\TrashedController@restore')->name('reward.trashed.restore');
    Route::delete('reward/trashed/destroy/{id}', 'Reward\TrashedController@destroy')->name('reward.trashed.destroy');

