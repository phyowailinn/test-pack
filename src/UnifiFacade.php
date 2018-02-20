<?php 

use Illuminate\Support\Facades\Facade;

class Unifi extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'unifi';
    }
}