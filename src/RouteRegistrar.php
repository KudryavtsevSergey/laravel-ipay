<?php

namespace Sun\IPay;

use Illuminate\Contracts\Routing\Registrar as Router;
use Sun\IPay\Http\Controllers\IPayController;

class RouteRegistrar
{
    public function __construct(
        private Router $router,
    ) {
    }

    public function routes(): void
    {
        $this->router->post('', [
            'uses' => 'IPayController@index',
            'as' => IPayController::ROUTE_NAME,
        ]);
    }
}
