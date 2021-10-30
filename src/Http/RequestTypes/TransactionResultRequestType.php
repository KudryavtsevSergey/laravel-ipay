<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\TransactionResultRequestDto;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\PaymentNotInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailablePaymentErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionResults\CancelTransactionResultXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\TransactionResults\ConfirmTransactionResultXmlGenerator;

class TransactionResultRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var TransactionResultRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, TransactionResultRequestDto::class);
        $orderChecker = $this->iPayService->getOrderChecker($request);
        if (!$orderChecker->isExist()) {
            return new OrderNotFoundErrorXmlGenerator($request);
        }

        if (!$orderChecker->isAvailablePay()) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        }

        if (!$this->iPayService->unlockPayOrder($request)) {
            return new PaymentNotInProcessErrorXmlGenerator($request);
        }

        if (!empty($request->getTransactionResult()->getErrorText())) {
            return new CancelTransactionResultXmlGenerator();
        }

        $this->iPayService->payOrder($request);

        return new ConfirmTransactionResultXmlGenerator();
    }
}
