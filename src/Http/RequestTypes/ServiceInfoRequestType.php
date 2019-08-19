<?php

namespace Sun\IPay\Http\RequestTypes;

use SimpleXMLElement;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Http\Responses\Errors\OrderNotFoundErrorResponse;
use Sun\IPay\Http\Responses\ServiceInfoResponse;
use Sun\IPay\Http\Responses\Errors\UnavailablePaymentErrorResponse;

class ServiceInfoRequestType extends RequestType
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

        $name = $this->iPayService->getPayerName($orderId);
        $surname = $this->iPayService->getPayerSurname($orderId);

        return new ServiceInfoResponse($orderId, $amount, $surname, $name);
    }
}
