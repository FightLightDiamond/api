<?php

Route::middleware(['api'])
    ->namespace('GCard\Http\Controllers\API')
    ->prefix('api/v1')
    ->name('api.')
    ->group(function () {
        Route::resource('heroes', 'HeroAPIController');
    });
