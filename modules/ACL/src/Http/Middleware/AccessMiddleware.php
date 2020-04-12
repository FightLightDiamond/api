<?php

namespace ACL\Http\Middleware;

use Closure;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $name)
    {
        if (\ACL::access($name)) {
            return $next($request);
        }
        session()->flash('error', 'Not Access');
        return back();
    }
}
