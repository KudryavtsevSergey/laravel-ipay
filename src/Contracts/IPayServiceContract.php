<?php

namespace Sun\IPay\Contracts;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;
use Sun\IPay\Dto\RequestDto\StornResultRequestDto;
use Sun\IPay\Dto\RequestDto\StornStartRequestDto;
use Sun\IPay\Dto\RequestDto\TransactionResultRequestDto;
use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;

interface IPayServiceContract
{
    public function getOrderChecker(BaseRequestDto $request): IPayOrderCheckerContract;

    public function getOrderInfo(BaseRequestDto $request): IPayOrderInfoContract;

    public function lockPayOrder(TransactionStartRequestDto $transactionStart): bool;

    public function unlockPayOrder(TransactionResultRequestDto $transactionResult): bool;

    public function payOrder(TransactionResultRequestDto $transactionResult): void;

    public function getStornAmount(StornStartRequestDto $stornStart): IPayAmountContract;

    public function lockStornOrder(StornStartRequestDto $stornStart): bool;

    public function unlockStornOrder(StornResultRequestDto $stornResult): bool;

    public function stornOrder(StornResultRequestDto $stornResult): bool;
}
