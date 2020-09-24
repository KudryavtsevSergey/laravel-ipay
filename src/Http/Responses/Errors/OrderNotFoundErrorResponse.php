<?php

namespace Sun\IPay\Http\Responses\Errors;

class OrderNotFoundErrorResponse extends ErrorResponse
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
        return sprintf('Заказ %s не найден.', $this->orderId);
    }
}
