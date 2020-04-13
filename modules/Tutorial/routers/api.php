<?php
Route::group(
    [
        'middleware' => ['api'],
        'namespace' => 'Tutorial\Http\Controllers\API',
        'prefix' => 'api/v1'
    ], function () {
    Route::resource('lessons', 'LessonAPIController');
});
