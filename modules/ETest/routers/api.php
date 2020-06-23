<?php

Route::namespace('ETest\Http\Controllers\API')
    ->middleware(['api', 'auth:api'])
    ->prefix('api/v1')
    ->group(function () {
        Route::resource('questions', 'QuestionAPIController');
        Route::resource('question-tests' , 'QuestionTestAPIController');
        Route::resource('tests' , 'TestAPIController');
    });
