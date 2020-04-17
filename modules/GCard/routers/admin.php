<?php

Route::middleware(['api'])
    ->namespace('GCard\Http\Controllers\Admin')
    ->prefix('api/admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('heroes', 'HeroAdminController');
    });
