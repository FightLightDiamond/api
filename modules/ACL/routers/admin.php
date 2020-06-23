<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 10:33 AM
 */


Route::name('admin.')
    ->namespace('ACL\Http\Controllers\Admin')
    ->middleware(['api', 'auth:admin'])
    ->prefix('api/v1/admin')
    ->group(function () {
        Route::resource('admins', 'AdminAdminController');
        Route::resource('users', 'UserAdminController');
        Route::resource('contacts', 'ContactAdminController');
//        Auth::routes();
    });



Route::group(['namespace' => 'ACL\Http\Controllers\Admin', 'middleware' => ['api', 'auth:admin']], function () {

//    Route::get('/admin', 'HomeController@index')->name('admin');

//    Route::group(['middleware' => 'auth:admin', 'prefix' => 'acl'], function () {
////        Route::resource('admins', 'AdminController');
//
////        Route::resource('users' , 'UserAdminController');
//
//        Route::group(['middleware' => 'role:admin'], function () {
//            Route::resource('permissions', 'PermissionController');
//            Route::resource('roles', 'RoleController');
//            Route::resource('users', 'UserController');
//            Route::put('renew-password/{id}', 'UserController@renewPassword')->name('renew-password');
//            Route::put('ban/{id}', 'UserController@ban')->name('users.ban');
//            Route::resource('verify-users', 'VerifyUserController');
//        });
//    });
});
