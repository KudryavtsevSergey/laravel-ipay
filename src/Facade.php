<?php

namespace Sun\IPay;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Facade extends IlluminateFacade
{
    public const FACADE_ACCESSOR = 'IPay';

    protected static function getFacadeAccessor()
    {
        return self::FACADE_ACCESSOR;
    }
}
