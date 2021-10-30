<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\ServiceInfoRequestDto;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\ServiceInfoXmlGenerator;

class ServiceInfoRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var ServiceInfoRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, ServiceInfoRequestDto::class);
        $orderChecker = $this->iPayService->getOrderChecker($request);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        }

        $orderInfo = $this->iPayService->getOrderInfo($request);

        return new ServiceInfoXmlGenerator($orderInfo);
    }
}
