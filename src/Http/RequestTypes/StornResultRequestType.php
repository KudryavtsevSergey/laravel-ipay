<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\StornNotInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailableStornErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\StornXmlGenerator;
use Sun\IPay\Models\StornResultModel;

class StornResultRequestType extends AbstractRequestType
{
    public function generateResponse(array $data): AbstractIPayXmlGenerator
    {
        $stornResult = StornResultModel::createFromArray($data);
        $orderChecker = $this->iPayService->getOrderChecker($stornResult);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($stornResult);
        }

        if (!$orderChecker->isAvailableStorn()) {
            return new UnavailableStornErrorXmlGenerator($stornResult);
        }

        if (!$this->iPayService->unlockStornOrder($stornResult)) {
            return new StornNotInProcessErrorXmlGenerator($stornResult);
        }

        $this->iPayService->stornOrder($stornResult);

        return new StornXmlGenerator();
    }
}
