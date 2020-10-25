<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectAmountErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\StornInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailableStornErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\StornXmlGenerator;
use Sun\IPay\Models\StornStartModel;

class StornStartRequestType extends AbstractRequestType
{
    public function generateResponse(array $data): AbstractIPayXmlGenerator
    {
        $stornStart = StornStartModel::createFromArray($data);
        $orderChecker = $this->iPayService->getOrderChecker($stornStart);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($stornStart);
        }

        if (!$orderChecker->isAvailableStorn()) {
            return new UnavailableStornErrorXmlGenerator($stornStart);
        }

        $amount = $this->iPayService->getStornAmount($stornStart);

        if ($amount != $stornStart->getFormattedAmount()) {
            return new IncorrectAmountErrorXmlGenerator();
        }

        if (!$this->iPayService->lockStornOrder($stornStart)) {
            return new StornInProcessErrorXmlGenerator($stornStart);
        }

        return new StornXmlGenerator();
    }
}
