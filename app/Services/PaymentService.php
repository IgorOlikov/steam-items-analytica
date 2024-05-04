<?php

namespace App\Services;

use App\Contracts\Payment;

class PaymentService implements Payment
{
    //const CURRENCY = 'RUB';
    //const PAYMENT_SYSTEM_DOMAIN = 'https://pay.freekassa.ru/';

    public function __construct(
        private readonly string $merchantId,
        private readonly string $secretWord,
        private readonly string $currency,
        private readonly string $paymentSystemDomain,
    )
    {

    }

    public function generatePaymentLink(string $orderAmount, string $orderId) :string
    {
        $sign = md5($this->merchantId . ':' . $orderAmount . ':' . $this->secretWord . ':' . $this->currency . ':' . $orderId);

        $paymentLink = $this->paymentSystemDomain . '?' . "m={$this->merchantId}&oa={$orderAmount}&currency={$this->currency}&o={$orderId}&s={$sign}";

        return $paymentLink;
    }


}
