<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\StornStartRequestDto;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectAmountErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectCurrencyErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\StornInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailableStornErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\StornXmlGenerator;

class StornStartRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var StornStartRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, StornStartRequestDto::class);
        $orderChecker = $this->iPayService->getOrderChecker($request);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }

        if (!$orderChecker->isAvailableStorn()) {
            return new UnavailableStornErrorXmlGenerator($request);
        }

        $amount = $this->iPayService->getStornAmount($request);

        if ($amount->getAmount() !== $request->getStornStart()->getAmount()) {
            return new IncorrectAmountErrorXmlGenerator();
        }

        if ($amount->getIPayCurrency() !== $request->getCurrency()) {
            return new IncorrectCurrencyErrorXmlGenerator();
        }

        if (!$this->iPayService->lockStornOrder($request)) {
            return new StornInProcessErrorXmlGenerator($request);
        }

        return new StornXmlGenerator();
    }
}
