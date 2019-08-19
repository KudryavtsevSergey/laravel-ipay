<?php

namespace Sun\IPay\Http\Responses\Errors;

class PaymentInProcessErrorResponse extends ErrorResponse
{
    public function __construct(int $orderId)
    {
        //TODO: localize
        parent::__construct("Заказ номер {$orderId} находится в процессе оплаты.");
    }
}
