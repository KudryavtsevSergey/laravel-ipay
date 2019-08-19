<?php

namespace Sun\IPay;

use Illuminate\Support\ServiceProvider;
use Sun\IPay\Services\IPayService;
use Sun\IPay\Services\IPayServiceContract;

class IPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/ipay.php' => config_path('ipay.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPayServiceContract::class, IPayService::class);
    }
}
