<?php

namespace App\Contracts;

interface Payment
{
    public function generatePaymentLink(string $orderAmount, string $orderId) :string;
}
