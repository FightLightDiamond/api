<?php

namespace ACL\Http\Middleware;

use Gate;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Permissions
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $requestPermissionCollection)
    {
        $requestPermissions = explode('|', $requestPermissionCollection);
        $permissions = [];
        foreach (auth()->user()->roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission;
            }
        }

        foreach ($requestPermissions as $accessPermission) {
            if (in_array($accessPermission, $permissions)) {
                return $next($request);
            }
        }

        return response()->view('errors.401', [], 401);
    }
}
