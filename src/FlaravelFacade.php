<?php

namespace Shadracnicholas\Flaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Shadracnicholas\Flaravel\Skeleton\SkeletonClass
 */
class FlaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flaravel';
    }
}
