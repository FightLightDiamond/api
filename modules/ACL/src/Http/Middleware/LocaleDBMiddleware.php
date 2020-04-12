<?php

namespace ACL\Http\Middleware;

use Closure;

class LocaleDBMiddleware
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
        \App::setLocale('en');
        if(auth()->check()) {
            $locale = auth()->user()->locale;

            if($locale) {
                \App::setLocale($locale);
            }
        }
        return $next($request);
    }
}
