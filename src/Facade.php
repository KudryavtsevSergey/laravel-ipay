<?php

namespace Sun\IPay;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Facade extends IlluminateFacade
{
    const FACADE = 'IPay';

    protected static function getFacadeAccessor()
    {
        return self::FACADE;
    }
}
