<?php

declare(strict_types=1);

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;
use Sun\IPay\Exceptions\Order\InvalidPaymentAmountException;
use Sun\IPay\Exceptions\Order\InvalidPaymentCurrencyException;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForPaymentException;
use Sun\IPay\Exceptions\Order\OrderNotFoundException;
use Sun\IPay\Exceptions\Order\PaymentInProcessException;
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
        $request = $this->arrayObjectMapper->deserialize($data, TransactionStartRequestDto::class);

        try {
            $transaction = $this->iPayService->startPayment($request);
            return new TransactionStartXmlGenerator($request, $transaction->getTransactionId());
        } catch (InvalidPaymentAmountException) {
            return new IncorrectAmountErrorXmlGenerator();
        } catch (InvalidPaymentCurrencyException) {
            return new IncorrectCurrencyErrorXmlGenerator();
        } catch (OrderNotAvailableForPaymentException) {
            return new UnavailablePaymentErrorXmlGenerator($request);
        } catch (OrderNotFoundException) {
            return new OrderNotFoundErrorXmlGenerator($request);
        } catch (PaymentInProcessException) {
            return new PaymentInProcessErrorXmlGenerator($request);
        }
    }
}
