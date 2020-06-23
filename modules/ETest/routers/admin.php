<?php

Route::namespace('ETest\Http\Controllers\Admin')
    ->middleware(['api', 'auth:admin'])
    ->prefix('api/v1/admin')
    ->group(function () {
        Route::resource('questions' , 'QuestionAdminController');
        Route::resource('question-tests' , 'QuestionTestAdminController');
        Route::resource('tests' , 'TestAdminController');
    });

