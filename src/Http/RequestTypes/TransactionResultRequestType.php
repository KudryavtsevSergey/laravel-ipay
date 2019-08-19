<?php

namespace Sun\IPay\Http\RequestTypes;

use SimpleXMLElement;
use Sun\IPay\Http\Responses\Errors\PaymentNotInProcessErrorResponse;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Http\Responses\Errors\OrderNotFoundErrorResponse;
use Sun\IPay\Http\Responses\TransactionResults\CancelTransactionResultResponse;
use Sun\IPay\Http\Responses\TransactionResults\ConfirmTransactionResultResponse;

class TransactionResultRequestType extends RequestType
{
    public function generateResponse(SimpleXMLElement $xml): IPayResponse
    {
        $orderId = (int)$xml->PersonalAccount;
        if (!$this->iPayService->orderExist($orderId)) {
            return new OrderNotFoundErrorResponse($orderId);
        }

        if (!$this->iPayService->unlockOrder($orderId)) {
            return new PaymentNotInProcessErrorResponse($orderId);
        }

        if (!empty($xml->TransactionResult->ErrorText)) {
            return new CancelTransactionResultResponse();
        }

        $this->iPayService->payOrder($orderId);

        return new ConfirmTransactionResultResponse();
    }
}
