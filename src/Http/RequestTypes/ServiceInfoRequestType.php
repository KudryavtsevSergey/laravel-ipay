<?php

declare(strict_types=1);

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\ServiceInfoRequestDto;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForPaymentException;
use Sun\IPay\Exceptions\Order\OrderNotFoundException;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\ServiceInfoXmlGenerator;

class ServiceInfoRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        $request = $this->arrayObjectMapper->deserialize($data, ServiceInfoRequestDto::class);

        try {
            $orderInfo = $this->iPayService->getOrderInfo($request);
            return new ServiceInfoXmlGenerator($orderInfo);
        } catch (OrderNotAvailableForPaymentException) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        } catch (OrderNotFoundException) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }
    }
}
