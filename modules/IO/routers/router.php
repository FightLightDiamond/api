<?php
/**
 * Created by PhpStorm.
 * User: diamond
 * Date: 3/18/19
 * Time: 10:29 AM
 */

Route::group(
    [
        'namespace' => 'IO\Http\Controllers',
        'prefix' => 'io-echo',
        'middleware' => ['web', 'auth'],
    ],
    function () {
        Route::get('send-msg', 'MessageController@index')->name('msg');
        Route::post('send', 'MessageController@send')->name('send');

        Route::get('/post', 'PostController@index');

        Route::get('/groups', 'GroupController@index');
        Route::post('/groups/{id}/notify', 'GroupController@notify')->name('notify');
//        Route::resource('messages' , 'MessageController');
    }
);

Route::group([
    'middleware' => ['web'],
], function () {

    Route::get('chat', function () {
        return view('io::home');
    });
});

Route::group([
        'namespace' => 'IO\Http\Controllers\API',
        'middleware' => ['api', 'auth:api'],
        'prefix' => 'api',
        'name' => 'api.'
], function () {
    Route::get('contacts', 'ContactAPIController@getContacts');
    Route::get('conversation/{id}', 'ContactAPIController@getMessageFor');
    Route::post('conversation/send', 'ContactAPIController@send');
//        Route::resource('messages' , 'MessageApiController');
    });

Route::get('marco', function () {
    $m = new \IO\Http\Controllers\MarcoTrait();
//    \IO\Http\Controllers\MarcoTrait::addMacro('fullName', function () {
//        return $this->firstName . ' ' . $this->lastName;
//    });
    return $m->fullName(3131);
});
