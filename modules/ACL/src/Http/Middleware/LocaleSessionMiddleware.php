<?php

namespace ACL\Http\Middleware;

use Closure;

class LocaleSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = \session()->pull('user.locale');
        if($locale) {
            \App::setLocale($locale);
        } else {
            \App::setLocale('en');
        }
        return $next($request);
    }
}
