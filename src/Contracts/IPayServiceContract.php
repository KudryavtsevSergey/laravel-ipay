<?php

namespace Sun\IPay\Contracts;

use Sun\IPay\Models\AbstractRequest;
use Sun\IPay\Models\ServiceInfo;
use Sun\IPay\Models\StornResult;
use Sun\IPay\Models\StornStart;
use Sun\IPay\Models\TransactionResult;
use Sun\IPay\Models\TransactionStart;

interface IPayServiceContract
{
    public function getOrderChecker(AbstractRequest $request): IPayOrderCheckerContract;

    public function getOrderInfo(ServiceInfo $serviceInfo): IPayOrderInfoContract;

    public function getPayAmount(AbstractRequest $transactionStart): IPayAmountContract;

    public function lockPayOrder(TransactionStart $transactionStart): bool;

    public function unlockPayOrder(TransactionResult $transactionResult): bool;

    public function payOrder(TransactionResult $transactionResult): void;

    public function getStornAmount(StornStart $stornStart): IPayAmountContract;

    public function lockStornOrder(StornStart $stornStart): bool;

    public function unlockStornOrder(StornResult $stornResult): bool;

    public function stornOrder(StornResult $stornResult): bool;
}
