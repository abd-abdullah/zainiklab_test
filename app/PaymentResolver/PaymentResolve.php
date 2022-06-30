<?php

namespace App\PaymentResolver;

class PaymentResolve{
    protected $paymentClass;

    public function __construct()
    {
        $this->paymentClass = config('payment.methods');
    }

    public function resolvePayment($paymentMethod)
    {
        return resolve($this->paymentClass[$paymentMethod]);
    }
}

?>