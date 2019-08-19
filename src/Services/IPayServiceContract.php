<?php

namespace Sun\IPay\Services;

interface IPayServiceContract
{
    public function orderExist($orderId): bool;

    public function orderAvailablePayment($orderId): bool;

    public function calculateAmount($orderId);

    public function getPayerName($orderId): string;

    public function getPayerSurname($orderId): string;

    public function lockOrder($orderId, $requestId): bool;

    public function unlockOrder($orderId): bool;

    public function payOrder($orderId);
}
