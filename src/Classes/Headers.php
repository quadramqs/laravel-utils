<?php

namespace Quadram\LaravelUtils\Classes;

class Headers
{
    /**
     * Return the name for a header key
     *
     * @return array
     */
    public static function getKeyName($key)
    {
        $keys = config('laravel-utils.headers');

        return $keys[$key];
    }

    /**
     * Return the header value for a key
     *
     * @return array
     */
    public static function header($key)
    {
        $name = self::getKeyName($key);

        return request()->header($name ?? null);
    }

    /**
     * Return the headers sent to the service as an array.
     *
     * @return array
     */
    public static function asArray()
    {
        $keys = ['x-api-key', 'language', 'os', 'app-version'];
        $headers = [];

        foreach ($keys as $key) {
            $headers[$key] = self::header($key);
        }

        return $headers;
    }

    /**
     * Return the apikey header param.
     *
     * @return string
     */
    public static function getApiKey()
    {
        return self::header('x-api-key');
    }

    /**
     * Return the language header param.
     *
     * @return string
     */
    public static function getLanguage()
    {
        $language = self::header('language');
        $languages = config('laravel-utils.languages');
        $defaultLanguage = config('laravel-utils.default_language');
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
     * Return the appVersion header param.
     *
     * @return string
     */
    public static function getAppVersion()
    {
        return self::header('app-version') ?? '0.0.0';
    }

    /**
     * Return the os header param.
     *
     * @return string
     */
    public static function getOs()
    {
        return self::header('os');
    }

    /**
     * Check if the os is Android.
     *
     * @return bool
     */
    public static function isAndroid()
    {
        return strtolower(config('laravel-utils.os.android')) === self::getOs();
    }

    /**
     * Check if the os is iOS.
     *
     * @return bool
     */
    public static function isIos()
    {
        return strtolower(config('laravel-utils.os.ios')) === self::getOs();
    }

    /**
     * Check if the os is Web.
     *
     * @return bool
     */
    public static function isWeb()
    {
        return strtolower(config('laravel-utils.os.web')) === self::getOs();
    }
}
