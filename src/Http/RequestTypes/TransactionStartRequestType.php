<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectAmountErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectCurrencyErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\PaymentInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionStartXmlGenerator;

class TransactionStartRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var TransactionStartRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, TransactionStartRequestDto::class);
        $orderChecker = $this->iPayService->getOrderChecker($request);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        }

        $orderInfo = $this->iPayService->getOrderInfo($request);
        $amount = $orderInfo->calculateAmount();

        if ($amount->getAmount() !== $request->getTransactionStart()->getAmount()) {
            return new IncorrectAmountErrorXmlGenerator();
        }

        if ($amount->getIPayCurrency() !== $request->getCurrency()) {
            return new IncorrectCurrencyErrorXmlGenerator();
        }

        if (!$this->iPayService->lockPayOrder($request)) {
            return new PaymentInProcessErrorXmlGenerator($request);
        }

        return new TransactionStartXmlGenerator($request);
    }
}
