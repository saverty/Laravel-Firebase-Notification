<?php

namespace Saverty\FirebaseNotification;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Saverty\FirebaseNotification\Skeleton\SkeletonClass
 */
class FirebaseNotificationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'firebase-notification';
    }
}
