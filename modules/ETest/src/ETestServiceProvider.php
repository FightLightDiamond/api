<?php

namespace ETest;

use ETest\Http\Repositories\QuestionRepository;
use ETest\Http\Repositories\QuestionRepositoryEloquent;
use ETest\Http\Repositories\QuestionTestRepository;
use ETest\Http\Repositories\QuestionTestRepositoryEloquent;
use ETest\Http\Repositories\TestRepository;
use ETest\Http\Repositories\TestRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class ETestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database');
        $this->loadRoutesFrom(__DIR__ . '/../routers/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    public function register()
    {
        $this->app->bind(QuestionRepository::class, QuestionRepositoryEloquent::class);
        $this->app->bind(QuestionTestRepository::class, QuestionTestRepositoryEloquent::class);
        $this->app->bind(TestRepository::class, TestRepositoryEloquent::class);
    }
}
