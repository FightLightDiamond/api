<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/8/2018
 * Time: 6:54 PM
 */
namespace ACL;

use ACL\Http\Repositories\ContactRepository;
use ACL\Http\Repositories\ContactRepositoryEloquent;
use ACL\Http\ViewComposers\PermissionComposer;
use ACL\Http\Repositories\AdminRepository;
use ACL\Http\Repositories\AdminRepositoryEloquent;
use ACL\Http\Repositories\PermissionRepository;
use ACL\Http\Repositories\PermissionRepositoryEloquent;
use ACL\Http\Repositories\RoleRepository;
use ACL\Http\Repositories\RoleRepositoryEloquent;
use ACL\Http\Repositories\UserRepository;
use ACL\Http\Repositories\UserRepositoryEloquent;
use ACL\Http\Facades\AccessFun;
use ACL\Http\ViewComposers\RoleComposer;
use ACL\Http\Repositories\VerifyUserRepository;
use ACL\Http\Repositories\VerifyUserRepositoryEloquent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'acl');
        $this->loadRoutesFrom(__DIR__ . '/../routers/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Validator::extend('otp', function ($attribute, $value, $parameters, $validator) {
            return auth()->user()->verifyOtp($value);
        });

        Validator::extend('correct_password', function ($attribute, $value, $parameters, $validator) {
            $user = auth()->user();
            return (password_verify($value, $user->password));
        });
    }

    public function register() {
        $this->app->bind('AccessFa', AccessFun::class);
        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);

        $this->app->bind(AdminRepository::class, AdminRepositoryEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(VerifyUserRepository::class, VerifyUserRepositoryEloquent::class);
    }
}
