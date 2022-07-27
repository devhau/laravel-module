<?php

namespace DevHau\Modules;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DevHau\Modules\Skeleton\SkeletonClass
 */
class ThemeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
