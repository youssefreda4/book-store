<?php

namespace App\Interfaces;

interface PaymentServiceInterface
{
    public function processPayment($data, $order): array;

    public function getAuthToken(): string;

    public function createOrder($authToken, $amountCents, $order): array;

    public function getPaymentKey($authToken, $orderId, $amountCents, $billingData): array;

    public function getPaymentUrl($paymentKey): string;
}
