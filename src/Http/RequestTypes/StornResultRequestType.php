<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\StornResultRequestDto;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\StornNotInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailableStornErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\StornXmlGenerator;

class StornResultRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var StornResultRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, StornResultRequestDto::class);
        $orderChecker = $this->iPayService->getOrderChecker($request);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }

        if (!$orderChecker->isAvailableStorn()) {
            return new UnavailableStornErrorXmlGenerator($request);
        }

        if (!$this->iPayService->unlockStornOrder($request)) {
            return new StornNotInProcessErrorXmlGenerator($request);
        }

        $this->iPayService->stornOrder($request);

        return new StornXmlGenerator();
    }
}
