<?php

declare(strict_types=1);

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\TransactionResultRequestDto;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForPaymentException;
use Sun\IPay\Exceptions\Order\OrderNotFoundException;
use Sun\IPay\Exceptions\Order\PaymentNotInProcessException;
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
        $request = $this->arrayObjectMapper->deserialize($data, TransactionResultRequestDto::class);

        try {
            $this->iPayService->registerPayment($request);
            if (!empty($request->getTransactionResult()->getErrorText())) {
                return new CancelTransactionResultXmlGenerator();
            }
            return new ConfirmTransactionResultXmlGenerator();
        } catch (OrderNotAvailableForPaymentException) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        } catch (OrderNotFoundException) {
            return new OrderNotFoundErrorXmlGenerator($request);
        } catch (PaymentNotInProcessException) {
            return new PaymentNotInProcessErrorXmlGenerator($request);
        }
    }
}
