<?php

namespace Sun\IPay\Http\Responses\Errors;

class OrderNotFoundErrorResponse extends ErrorResponse
{
    public function __construct(int $orderId)
    {
        //TODO: localize
        parent::__construct("Заказ {$orderId} не найден.");
    }
}
