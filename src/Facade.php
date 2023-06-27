<?php

declare(strict_types=1);

namespace Sun\IPay;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @method static void ignoreRoutes()
 */
class Facade extends IlluminateFacade
{
    public const FACADE_ACCESSOR = 'IPay';

    protected static function getFacadeAccessor(): string
    {
        return self::FACADE_ACCESSOR;
    }
}
