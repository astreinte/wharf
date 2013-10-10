<?php namespace Wharf\Loadroutes;

use Illuminate\Support\Facades\Facade;

class LoadroutesFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'loadroutes'; }

}