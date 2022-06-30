<?php

namespace App\PaymentProvider;

use Illuminate\Http\Request;

interface PaymentService{

    public function handlePayment(Request $request);

    public function success(Request $request);

    public function cancel();

}

?>