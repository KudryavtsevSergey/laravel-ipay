<?php

namespace Sun\IPay\Http\RequestTypes;

use SimpleXMLElement;
use Sun\IPay\Http\Responses\Errors\IncorrectAmountErrorResponse;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Http\Responses\Errors\OrderNotFoundErrorResponse;
use Sun\IPay\Http\Responses\Errors\PaymentInProcessErrorResponse;
use Sun\IPay\Http\Responses\TransactionStartResponse;
use Sun\IPay\Http\Responses\Errors\UnavailablePaymentErrorResponse;

class TransactionStartRequestType extends RequestType
{
    public function generateResponse(SimpleXMLElement $xml): IPayResponse
    {
        $orderId = (int)$xml->PersonalAccount;
        if (!$this->iPayService->orderExist($orderId)) {
            return new OrderNotFoundErrorResponse($orderId);
        }

        if (!$this->iPayService->orderAvailablePayment($orderId)) {
            return new UnavailablePaymentErrorResponse($orderId);
        }

        $amount = $this->iPayService->calculateAmount($orderId);

        $requestAmount = floatval(str_replace(',', '.', $xml->TransactionStart->Amount));

        if ($amount != $requestAmount) {
            return new IncorrectAmountErrorResponse();
        }

        $requestId = (int)$xml->RequestId;

        if (!$this->iPayService->lockOrder($orderId, $requestId)) {
            return new PaymentInProcessErrorResponse($orderId);
        }

        return new TransactionStartResponse($orderId);
    }
}
