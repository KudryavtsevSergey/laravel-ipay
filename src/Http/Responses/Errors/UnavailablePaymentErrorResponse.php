<?php

namespace Sun\IPay\Http\Responses\Errors;

class UnavailablePaymentErrorResponse extends ErrorResponse
{
    public function __construct(int $orderId)
    {
        //TODO: localize
        parent::__construct("Заказ {$orderId} недоступен для оплаты.");
    }
}
