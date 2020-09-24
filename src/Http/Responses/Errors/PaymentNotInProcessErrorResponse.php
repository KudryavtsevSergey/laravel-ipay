<?php

namespace Sun\IPay\Http\Responses\Errors;

class PaymentNotInProcessErrorResponse extends ErrorResponse
{
    private int $orderId;

    public function __construct(int $orderId)
    {
        parent::__construct();
        $this->orderId = $orderId;
    }

    protected function getErrorMessage(): string
    {
        // TODO: localize
        return sprintf('Заказ номер %s не находится в процессе оплаты.', $this->orderId)
    }
}
