<?php
///**
// * Created by PhpStorm.
// * User: JK
// * Date: 3/8/2018
// * Time: 7:45 PM
// */
//
//Route::group(['namespace' => 'ACL\Http\Controllers', 'middleware' => ['web', 'locale.db']], function () {
//    Auth::routes();
//
//    Route::get('/locale-session/{locale}', 'LocaleController@session')->name('locale.session');
//
//    Route::group(['middleware' => 'auth', 'prefix' => 'acl'], function () {
//        Route::get('profile', 'UserController@profile')->name('acl.profile');
//        Route::put('profile/{id}', 'UserController@updateProfile')->name('profile.update');
//        Route::put('change-password', 'UserController@changePassword')->name('change-password');
//        Route::put('transaction', 'UserController@transaction')->name('transaction');
//        Route::post('google-otp', 'ProfileController@createGoogleOtp')->name('otp.google');
//        Route::post('google-otp-enable', 'ProfileController@enableOtp')->name('otp.google.enable');
//        Route::post('google-otp-disable', 'ProfileController@disableOtp')->name('otp.google.disable');
//        Route::get('/locale-db', 'LocaleController@db')->name('locale.db');
//    });
//    Route::get('verify-email/{code}', 'VerifyUserController@email')->name('verify.email');
//});
//
