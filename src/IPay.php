<?php

namespace Sun\IPay;

use Illuminate\Contracts\Routing\Registrar as Router;
use Route;

class IPay
{
    public function routes(array $options = []): void
    {
        $defaultOptions = ['prefix' => 'ipay', 'namespace' => '\Sun\IPay\Http\Controllers'];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function (Router $router): void {
            (new RouteRegistrar($router))->routes();
        });
    }
}
