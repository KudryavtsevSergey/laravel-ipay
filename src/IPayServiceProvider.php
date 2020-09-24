<?php

namespace Sun\IPay;

use Illuminate\Support\ServiceProvider;
use Sun\IPay\Services\IPayService;
use Sun\IPay\Services\IPayServiceContract;

class IPayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ipay.php' => config_path('ipay.php')
        ], 'config');
    }

    public function register()
    {
        $this->app->bind(IPayServiceContract::class, IPayService::class);
    }
}
