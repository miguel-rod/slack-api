<?php

namespace MiguelRod\SlackApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MiguelRod\SlackApi\Skeleton\SkeletonClass
 */
class SlackApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'slack-api';
    }
}
