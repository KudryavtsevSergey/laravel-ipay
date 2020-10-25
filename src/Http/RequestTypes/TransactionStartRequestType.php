<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectAmountErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectCurrencyErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\PaymentInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionStartXmlGenerator;
use Sun\IPay\Models\TransactionStartModel;

class TransactionStartRequestType extends AbstractRequestType
{
    public function generateResponse(array $data): AbstractIPayXmlGenerator
    {
        $transactionStart = TransactionStartModel::createFromArray($data);
        $orderChecker = $this->iPayService->getOrderChecker($transactionStart);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($transactionStart);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($transactionStart);
        }

        $amount = $this->iPayService->getPayAmount($transactionStart);

        if ($amount->getAmount() != $transactionStart->getFormattedAmount()) {
            return new IncorrectAmountErrorXmlGenerator();
        }

        if ($amount->getIPayCurrency() != $transactionStart->getCurrency()) {
            return new IncorrectCurrencyErrorXmlGenerator();
        }

        if (!$this->iPayService->lockPayOrder($transactionStart)) {
            return new PaymentInProcessErrorXmlGenerator($transactionStart);
        }

        return new TransactionStartXmlGenerator($transactionStart);
    }
}
