<?php

namespace Sun\IPay;

use Illuminate\Support\ServiceProvider;

class IPayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'ipay');

        $this->publishes([
            __DIR__ . '/../config/ipay.php' => config_path('ipay.php')
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton(Facade::FACADE_ACCESSOR, IPay::class);
    }
}
