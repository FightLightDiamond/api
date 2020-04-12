<?php
/**
 * Created by PhpStorm.
 * User: diamond
 * Date: 2/15/19
 * Time: 11:11 AM
 */

Route::name('api.')
    ->namespace('ACL\Http\Controllers\API')
    ->prefix('api/v1')
    ->middleware(['api', 'cors','throttle'])
    ->group( function () {
        Route::resource('users' , 'UserAPIController');
//        Route::resource('contacts' , 'ContactAPIController');
    });

Route::name('api.')
    ->namespace('ACL\Http\Controllers\Auth')
    ->prefix('api')
    ->middleware(['api', 'cors','throttle'])
    ->group( function () {

        Route::post('/login', 'API\LoginController@login')->name('login')->middleware('oauth.providers');
        Route::post('/register', 'API\RegisterController@register')->name('register');
        Route::post('/forgot-password', 'API\ForgotPasswordController@sendResetLinkEmail')->name('forgot-password');
        Route::post('/reset-password', 'API\ResetPasswordController@reset')->name('reset-password');
        Route::post('/change-password', 'API\ChangePasswordController@change')->name('change-password');
//        Route::post('oauth/token', 'API\AccessTokenController@issueToken')->name('passport.token');
    });

//Route::name('api.')
//    ->namespace('ACL\Http\Controllers\Admin')
//    ->prefix('api/v1/admin')
//    ->middleware(['api'])
//    ->group( function () {
//        Route::resource('users' , 'UserAdminController');
//        Route::resource('admins' , 'AdminAdminController');
////        Route::resource('contacts' , 'ContactAdminController');
//    });
