<?php 

namespace Mkdevs\MultiTenant\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * MultiTenant Facade
 *
 */

class MultiTenant extends Facade {

    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MultiTenant';
    }
}