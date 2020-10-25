<?php

namespace Sun\IPay;

use Illuminate\Contracts\Routing\Registrar as Router;
use Route;

class IPay
{
    public function routes(array $options = [])
    {
        $defaultOptions = ['prefix' => 'ipay', 'namespace' => '\Sun\IPay\Http\Controllers'];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function (Router $router) {
            (new RouteRegistrar($router))->routes();
        });
    }
}
