<?php

namespace App\PaymentProvider;

use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\PaymentProvider\PaymentService;
use Stripe;

class StripeProvider implements PaymentService{

    public function handlePayment(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $stripe = new \Stripe\StripeClient(config('stripe.secret'));
        $session = $stripe->checkout->sessions->create([
            'success_url' => route('pay.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('pay.cancel'),
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => $course->name,
                        ],
                        'unit_amount' => $request->total_amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
        ]);

        return redirect()->to($session->url, 303);
        
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));

        $session = \Stripe\Checkout\Session::retrieve([
            'id' => $request->get('session_id'),
            'expand' => ['payment_intent.payment_method'],
        ]);

        $response = $session->payment_intent->payment_method;
        $transaction = Transaction::where('transaction_id', session()->get('transaction_id'))->first();
        $transaction->update(['status' => 'COMPLETED', 'payment_details' => json_encode($response)]);

        $transaction->course->students()->syncWithoutDetaching($transaction->user_id);

        return redirect()->route('welcome')->with('success', 'You have completed the purchase.');
    }

    public function cancel()
    {
        Transaction::where('transaction_id', session()->get('transaction_id'))->update(['status' => 'CANCELED']);
        return redirect()->route('welcome')->with('error', 'You have canceled the transaction.');
    }
}
