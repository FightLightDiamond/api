<?php

namespace Tutorial;

use Illuminate\Support\ServiceProvider;
use Tutorial\Http\Repositories\UserTutorialRepository;
use Tutorial\Http\Repositories\UserTutorialRepositoryEloquent;
use Tutorial\Http\Repositories\LessonCommentRepository;
use Tutorial\Http\Repositories\LessonCommentRepositoryEloquent;
use Tutorial\Http\Repositories\LessonFeedBackRepository;
use Tutorial\Http\Repositories\LessonFeedBackRepositoryEloquent;
use Tutorial\Http\Repositories\LessonRepository;
use Tutorial\Http\Repositories\LessonRepositoryEloquent;
use Tutorial\Http\Repositories\LessonResultRepository;
use Tutorial\Http\Repositories\LessonResultRepositoryEloquent;
use Tutorial\Http\Repositories\LessonSubCommentRepository;
use Tutorial\Http\Repositories\LessonSubCommentRepositoryEloquent;
use Tutorial\Http\Repositories\LessonTestRepository;
use Tutorial\Http\Repositories\LessonTestRepositoryEloquent;
use Tutorial\Http\Repositories\SectionRepository;
use Tutorial\Http\Repositories\SectionRepositoryEloquent;
use Tutorial\Http\Repositories\SectionResultRepository;
use Tutorial\Http\Repositories\SectionResultRepositoryEloquent;
use Tutorial\Http\Repositories\SectionTestRepository;
use Tutorial\Http\Repositories\SectionTestRepositoryEloquent;
use Tutorial\Http\Repositories\TutorialRepository;
use Tutorial\Http\Repositories\TutorialRepositoryEloquent;
use Tutorial\Http\Repositories\TutorialResultRepository;
use Tutorial\Http\Repositories\TutorialResultRepositoryEloquent;
use Tutorial\Http\Repositories\TutorialTestRepository;
use Tutorial\Http\Repositories\TutorialTestRepositoryEloquent;

class TutorialServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database');
        $this->loadRoutesFrom(__DIR__ . '/../routers/router.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tut');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TutorialRepository::class, TutorialRepositoryEloquent::class);
        $this->app->bind(TutorialResultRepository::class, TutorialResultRepositoryEloquent::class);
        $this->app->bind(TutorialTestRepository::class, TutorialTestRepositoryEloquent::class);

        $this->app->bind(SectionRepository::class, SectionRepositoryEloquent::class);
        $this->app->bind(SectionTestRepository::class, SectionTestRepositoryEloquent::class);
        $this->app->bind(SectionResultRepository::class, SectionResultRepositoryEloquent::class);

        $this->app->bind(LessonTestRepository::class, LessonTestRepositoryEloquent::class);
        $this->app->bind(LessonCommentRepository::class, LessonCommentRepositoryEloquent::class);
        $this->app->bind(LessonFeedBackRepository::class, LessonFeedBackRepositoryEloquent::class);
        $this->app->bind(LessonRepository::class, LessonRepositoryEloquent::class);
        $this->app->bind(LessonSubCommentRepository::class, LessonSubCommentRepositoryEloquent::class);
        $this->app->bind(LessonResultRepository::class, LessonResultRepositoryEloquent::class);

        $this->app->bind(UserTutorialRepository::class, UserTutorialRepositoryEloquent::class);
    }
}
