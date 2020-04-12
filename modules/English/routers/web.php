<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 4:37 PM
 */

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'English\Http\Controllers', 'prefix' => 'english'], function () {
    Route::group(['prefix' => 'test', 'namespace' => 'Test'], function () {
        Route::get('fill-in-the-blanks', 'FillInTheBlankTestController@index')->name('test.fill-in-the-blank.index');
        Route::post('fill-in-the-blanks', 'FillInTheBlankTestController@done')->name('test.fill-in-the-blank.done');
        Route::get('pronunciations', 'PronunciationTestController@index')->name('test.pronunciation.index');
        Route::post('pronunciations', 'PronunciationTestController@done')->name('test.pronunciation.done');
        Route::get('mistakes', 'MistakeTestController@index')->name('test.mistake.index');
        Route::post('mistakes', 'MistakeTestController@done')->name('test.mistake.done');
        Route::get('similarities', 'SimilarityTestController@index')->name('test.similarity.index');
        Route::post('similarities', 'SimilarityTestController@done')->name('test.similarity.done');
        Route::get('crazies', 'CrazyTestController@index')->name('test.crazy.index');
        Route::get('crazy-read/{id}', 'CrazyTestController@reading')->name('test.crazy.reading');
        Route::post('crazy-read/{id}', 'CrazyTestController@read')->name('test.crazy.read');
        Route::get('crazy-write/{id}', 'CrazyTestController@writing')->name('test.crazy.writing');
        Route::post('crazy-write/{id}', 'CrazyTestController@written')->name('test.crazy.written');
    });

    Route::get('/', 'EnglishController@index')->name('english.index');
    Route::get('crazy-course-list/{id}', 'CrazyCourseController@getList')->name('crazy-course.list');
    Route::get('searches', 'VocabularyController@search')->name('vocabulary.search');
});