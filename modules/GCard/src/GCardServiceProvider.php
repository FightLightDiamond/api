<?php

namespace GCard;
use GCard\Http\Repositories\HeroRepository;
use GCard\Http\Repositories\HeroRepositoryEloquent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class GCardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routers/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');

        $this->commands([
//            RemindCommand::class
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
//            $schedule->command('remind:english')->cron('* * * * *');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HeroRepository::class, HeroRepositoryEloquent::class);
    }
}
