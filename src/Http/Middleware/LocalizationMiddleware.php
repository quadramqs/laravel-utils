<?php

namespace Quadram\LaravelUtils\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Quadram\LaravelUtils\Classes\Headers;

class LocalizationMiddleware
{

    public function getLocale()
    {
        $language = Headers::header('language');
        $languages = config('laravel-utils.languages');
        $defaultLanguage = config('app.locale');
        $languageOverride = config('laravel-utils.language_override');

        $languageOverrideKeys = array_keys(config('laravel-utils.language_override'));

        if (!$language || !$languages) {
            return $defaultLanguage;
        }

        if(in_array($language, $languageOverrideKeys)) {
            return $languageOverride[$language];
        }

        return in_array($language, $languages) ? $language : $defaultLanguage;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale($this->getLocale());

        return $next($request);
    }
}
