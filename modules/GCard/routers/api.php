<?php

Route::middleware(['api'])
    ->namespace('GCard\Http\Controllers\API')
    ->prefix('api')
    ->name('api.')
    ->group(function () {
        Route::resource('heroes', 'HeroAPIController');
    });
