<?php

namespace Sun\IPay\Contracts;

use Sun\IPay\Dto\RequestDto\ServiceInfoRequestDto;
use Sun\IPay\Dto\RequestDto\StornResultRequestDto;
use Sun\IPay\Dto\RequestDto\StornStartRequestDto;
use Sun\IPay\Dto\RequestDto\TransactionResultRequestDto;
use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;
use Sun\IPay\Exceptions\Order\InvalidPaymentAmountException;
use Sun\IPay\Exceptions\Order\InvalidPaymentCurrencyException;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForPaymentException;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForStornException;
use Sun\IPay\Exceptions\Order\OrderNotFoundException;
use Sun\IPay\Exceptions\Order\PaymentInProcessException;
use Sun\IPay\Exceptions\Order\PaymentNotInProcessException;
use Sun\IPay\Exceptions\Order\StornNotInProcessException;

interface IPayServiceContract
{
    /**
     * @param ServiceInfoRequestDto $request
     * @return IPayOrderInfoContract
     * @throws OrderNotFoundException
     * @throws OrderNotAvailableForPaymentException
     */
    public function getOrderInfo(ServiceInfoRequestDto $request): IPayOrderInfoContract;

    /**
     * @param TransactionStartRequestDto $request
     * @return IPayTransactionContract
     * @throws InvalidPaymentAmountException
     * @throws InvalidPaymentCurrencyException
     * @throws OrderNotFoundException
     * @throws OrderNotAvailableForPaymentException
     * @throws PaymentInProcessException
     */
    public function startPayment(TransactionStartRequestDto $request): IPayTransactionContract;

    /**
     * @param TransactionResultRequestDto $request
     * @return void
     * @throws OrderNotFoundException
     * @throws OrderNotAvailableForPaymentException
     * @throws PaymentNotInProcessException
     */
    public function registerPayment(TransactionResultRequestDto $request): void;

    /**
     * @param StornStartRequestDto $request
     * @return void
     * @throws InvalidPaymentAmountException
     * @throws OrderNotFoundException
     * @throws OrderNotAvailableForStornException
     * @throws StornNotInProcessException
     */
    public function startStorn(StornStartRequestDto $request): void;

    /**
     * @param StornResultRequestDto $request
     * @return void
     * @throws InvalidPaymentAmountException
     * @throws OrderNotFoundException
     * @throws OrderNotAvailableForStornException
     * @throws StornNotInProcessException
     */
    public function registerStorn(StornResultRequestDto $request): void;
}
