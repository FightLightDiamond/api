<?php
/**
 * Created by PhpStorm.
 * User: diamond
 * Date: 3/18/19
 * Time: 10:23 AM
 */

namespace IO;


use Illuminate\Support\ServiceProvider;
use IO\Http\Repositories\MessageRepository;
use IO\Http\Repositories\MessageRepositoryEloquent;

class IOServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'io');
        $this->loadRoutesFrom(__DIR__ . '/../routers/router.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessageRepository::class, MessageRepositoryEloquent::class);
    }
}
