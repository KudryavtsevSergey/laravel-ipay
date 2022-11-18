<?php

namespace Sun\IPay;

class IPay
{
    public static bool $registersRoutes = true;

    public static function ignoreRoutes(): void
    {
        static::$registersRoutes = false;
    }
}
