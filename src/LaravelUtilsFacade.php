<?php

namespace Quadram\LaravelUtils;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Quadram\LaravelUtils\Skeleton\SkeletonClass
 */
class LaravelUtilsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-utils';
    }
}
