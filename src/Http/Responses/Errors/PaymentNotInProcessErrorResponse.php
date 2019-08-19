<?php

namespace Sun\IPay\Http\Responses\Errors;

class PaymentNotInProcessErrorResponse extends ErrorResponse
{
    public function __construct(int $orderId)
    {
        //TODO: localize
        parent::__construct("Заказ номер {$orderId} не находится в процессе оплаты.");
    }
}
