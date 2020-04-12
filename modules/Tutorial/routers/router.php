<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/25/2018
 * Time: 11:33 PM
 */
Route::group(
    [
        'middleware' => ['web', 'auth:admin', 'role:admin|teacher'],
        'namespace' => 'Tutorial\Http\Controllers',
        'prefix' => 'tut'
    ], function () {

    Route::resource('tutorial', 'TutorialController');
//    Route::get('tut-list', 'TutorialController@lists')->name('tutorial.list');
//    Route::resource('tutorial-test', 'TutorialTestController');
//    Route::resource('tutorial-result', 'TutorialResultController');

    Route::resource('section', 'SectionController');
//    Route::get('section-list', 'SectionController@lists')->name('section.list');
//    Route::resource('section-result', 'SectionResultController');
//    Route::resource('section-test', 'SectionTestController');

    Route::resource('lesson', 'LessonController');
//    Route::get('lesson-list', 'LessonController@lists')->name('lesson.list');
    Route::resource('lesson-test', 'LessonTestController');
//    Route::resource('lesson-result', 'LessonResultController');
//    Route::resource('lesson-feed-back', 'LessonFeedBackController');
//    Route::resource('lesson-sub-comment', 'LessonSubCommentController');
//    Route::resource('lesson-comment', 'LessonCommentController');

//    Route::group(['namespace' => 'API', 'middleware' => ['web']], function () {
//        Route::resource('lesson-comment-api', 'LessonCommentAPIController');
//    });
//    Route::group(['namespace' => 'Admin'], function () {
//        Route::resource('user-tutorials', 'UserTutorialAdminController');
//        Route::get('tutorials-manager-users/{id}', 'MangerUserTutorialAdminController@managerUsers')->name('tutorial.managerUsers');
//    });

//    Route::get('tutorials-search-list', 'TutorialController@searchList')->name('tutorial.searchList');

});




