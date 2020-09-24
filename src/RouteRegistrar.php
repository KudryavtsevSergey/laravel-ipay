<?php

namespace Sun\IPay;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function apiRoutes()
    {
        $this->router->post('', [
            'uses' => 'IPayController@index',
            'as' => 'ipay.index',
        ]);
    }
}
