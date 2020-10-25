<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\PaymentNotInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionResults\CancelTransactionResultXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionResults\ConfirmTransactionResultXmlGenerator;
use Sun\IPay\Models\TransactionResultModel;

class TransactionResultRequestType extends AbstractRequestType
{
    public function generateResponse(array $data): AbstractIPayXmlGenerator
    {
        $transactionResult = TransactionResultModel::createFromArray($data);
        $orderChecker = $this->iPayService->getOrderChecker($transactionResult);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($transactionResult);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($transactionResult);
        }

        if (!$this->iPayService->unlockPayOrder($transactionResult)) {
            return new PaymentNotInProcessErrorXmlGenerator($transactionResult);
        }

        if (!empty($transactionResult->getErrorText())) {
            return new CancelTransactionResultXmlGenerator();
        }

        $this->iPayService->payOrder($transactionResult);

        return new ConfirmTransactionResultXmlGenerator();
    }
}
