<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 4:37 PM
 */

//Route::middleware(['web', 'auth:admin', 'role:admin'])
//    ->namespace('English\Http\Controllers\Admin')
//    ->prefix('admin')
//    ->name('admin.')
//    ->group(function () {
//        Route::resource('crazy-write-histories' , 'CrazyWriteHistoryController');
//        Route::resource('fill-in-the-blanks', 'FillInTheBlankController');
//        Route::resource('pronunciations', 'PronunciationController');
//        Route::resource('mistakes', 'MistakeController');
//        Route::resource('vocabularies', 'VocabularyController');
//        Route::resource('similarities', 'SimilarityController');
//        Route::resource('crazies', 'CrazyController');
//        Route::resource('crazy-details', 'CrazyDetailController');
//        Route::resource('crazy-histories', 'CrazyHistoryController');
//        Route::resource('crazy-courses', 'CrazyCourseController');
//
//        Route::post('imports', 'VocabularyController@import')->name('vocabulary.import');
//    });

Route::middleware(['api'])
    ->namespace('English\Http\Controllers\Admin')
    ->prefix('api/v1/admin')
    ->name('api.admin.')
    ->group(function () {
        Route::resource('crazy-listen-histories' , 'CrazyListenHistoryAdminController');

        Route::get('/dashboard', 'DashboardController@index')->name('english.dashboard');

        Route::resource('blogs' , 'BlogAdminController');
        Route::resource('crazies', 'CrazyAdminController');
        Route::resource('crazy-courses', 'CrazyCourseAdminController');

        Route::resource('crazy-listen-histories' , 'CrazyListenHistoryAdminController');
        Route::resource('crazy-speak-histories' , 'CrazySpeakHistoryAdminController');
    });
