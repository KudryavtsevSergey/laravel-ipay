<?php

namespace Sun\IPay;

use Illuminate\Contracts\Routing\Registrar as Router;
use Sun\IPay\Http\Middleware\SafeWrapper;

class RouteRegistrar
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function routes()
    {
        $this->router->group(['middleware' => SafeWrapper::class], function (Router $router) {
            $router->post('', [
                'uses' => 'IPayController@index',
                'as' => 'ipay.index',
            ]);
        });
    }
}
