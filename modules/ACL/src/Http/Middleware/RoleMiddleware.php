<?php

namespace ACL\Http\Middleware;

use ACL\Http\Repositories\RoleRepository;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    private $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request, Closure $next, $name)
    {
        if ($this->repository->is($name)) {
            return $next($request);
        }
        session()->flash('error', 'Not Role');
        return back();
    }
}
