<?php

namespace Quadram\LaravelUtils\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Quadram\LaravelUtils\Classes\Headers;

class LocalizationMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale(Headers::getLanguage());

        return $next($request);
    }
}
