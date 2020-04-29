<?php
Route::group(
    [
        'middleware' => ['api'],
        'namespace' => 'Tutorial\Http\Controllers\API',
        'prefix' => 'api/v1'
    ], function () {
    Route::resource('sections' , 'SectionAPIController');
    Route::resource('lessons', 'LessonAPIController');
    Route::resource('tutorials' , 'TutorialAPIController');
});
