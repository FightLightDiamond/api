<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 4:37 PM
 */

Route::middleware(['api'])
    ->namespace('English\Http\Controllers\API')
    ->prefix('api')
    ->name('api.')
    ->group(function () {
        Route::get('/english', 'EnglishAPIController@index')->name('english.index');

        Route::resource('blogs' , 'BlogAPIController');

        Route::resource('crazies' , 'CrazyAPIController');
        Route::resource('crazy-listen-histories' , 'CrazyListenHistoryAPIController');

        Route::get('crazy-courses/{id}', 'CrazyCourseAPIController@show')->name('crazy-course.list');
        Route::get('crazy-courses', 'CrazyCourseAPIController@index')->name('crazy-courses.index');

        Route::resource('crazy-listen-histories' , 'CrazyListenHistoryAPIController');
        Route::resource('crazy-read-histories' , 'CrazyReadHistoryAPIController');
        Route::resource('crazy-write-histories' , 'CrazyWriteHistoryAPIController');
        Route::resource('crazy-speak-histories' , 'CrazySpeakHistoryAPIController');

        Route::get('crazy-histories' , 'HistoryAPIController@index');

        Route::group(['prefix' => 'test', 'namespace' => 'Test'], function () {
            Route::get('crazies', 'CrazyTestAPIController@index')->name('test.crazy.index');
            Route::get('crazy-listen/{id}', 'CrazyTestAPIController@listening')->name('test.crazy.listening');
            Route::post('crazy-listen/{id}', 'CrazyTestAPIController@listen')->name('test.crazy.listen');
            Route::get('crazy-read/{id}', 'CrazyTestAPIController@reading')->name('test.crazy.reading');
            Route::post('crazy-read/{id}', 'CrazyTestAPIController@read')->name('test.crazy.read');
            Route::get('crazy-write/{id}', 'CrazyTestAPIController@writing')->name('test.crazy.writing');
            Route::post('crazy-write/{id}', 'CrazyTestAPIController@written')->name('test.crazy.written');
            Route::post('crazy-speak/{id}', 'CrazyTestAPIController@speak')->name('test.crazy.speak');

            Route::get('fill-in-the-blanks', 'FillInTheBlankTestAPIController@index')->name('test.fill-in-the-blank.index');
            Route::post('fill-in-the-blanks', 'FillInTheBlankTestAPIController@done')->name('test.fill-in-the-blank.done');

            Route::get('mistakes', 'MistakeTestAPIController@index')->name('test.mistake.index');
            Route::post('mistakes', 'MistakeTestAPIController@done')->name('test.mistake.done');

            Route::get('pronunciations', 'PronunciationTestAPIController@index')->name('test.pronunciation.index');
            Route::post('pronunciations', 'PronunciationTestAPIController@done')->name('test.pronunciation.done');

            Route::get('similarities', 'SimilarityTestAPIController@index')->name('test.similarity.index');
            Route::post('similarities', 'SimilarityTestAPIController@done')->name('test.similarity.done');
        });

        Route::resource('reminds' , 'RemindAPIController');
    });
