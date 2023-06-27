<?php

declare(strict_types=1);

namespace Sun\IPay;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class IPayServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerTranslations();
        $this->registerPublishing();
    }

    protected function registerRoutes(): void
    {
        if (IPay::$registersRoutes) {
            Route::group([
                'prefix' => config('ipay.path', 'ipay'),
            ], function (): void {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
        }
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'ipay');
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ipay.php' => config_path('ipay.php')
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->app->singleton(Facade::FACADE_ACCESSOR, IPay::class);
    }
}
