<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\ServiceInfoXmlGenerator;
use Sun\IPay\Models\ServiceInfoModel;

class ServiceInfoRequestType extends AbstractRequestType
{
    public function generateResponse(array $data): AbstractIPayXmlGenerator
    {
        $serviceInfo = ServiceInfoModel::createFromArray($data);
        $orderChecker = $this->iPayService->getOrderChecker($serviceInfo);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($serviceInfo);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($serviceInfo);
        }

        $orderInfo = $this->iPayService->getOrderInfo($serviceInfo);
        $amount = $this->iPayService->getPayAmount($serviceInfo);

        return new ServiceInfoXmlGenerator($orderInfo, $amount);
    }
}
