<?php

namespace SMOMO;

use Illuminate\Support\ServiceProvider;

class SMOMOServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../config/momo.php' => config_path('momo.php'),
        ], 'momo');

        $this->mergeConfigFrom(__DIR__ . '/../config/momo.php', 'momo');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
