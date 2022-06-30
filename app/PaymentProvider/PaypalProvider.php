<?php

namespace App\PaymentProvider;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\PaymentProvider\PaymentService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalProvider implements PaymentService{
    
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function handlePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('pay.success'),
                "cancel_url" => route('pay.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->total_amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('welcome')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('welcome')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
  
    /**
     * Responds success after payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $transaction = Transaction::where('transaction_id', session()->get('transaction_id'))->first();
            $transaction->update(['status' => 'COMPLETED', 'payment_details' => json_encode($response)]);

            $transaction->course->students()->syncWithoutDetaching($transaction->user_id);

            return redirect()->route('welcome')->with('success', 'You have completed the purchase.');
            
        } else {
            Transaction::where('transaction_id', session()->get('transaction_id'))->update(['status' => 'FAILED', 'payment_details' => json_encode($response)]);
            return redirect()->route('welcome')->with('error', 'Your transaction was failed.');
        }
    }
    
    /**
     * Responds canceled after payment canceled
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        Transaction::where('transaction_id', session()->get('transaction_id'))->update(['status' => 'CANCELED']);
        return redirect()->route('welcome')->with('error', 'You have canceled the transaction.');
    }
}
?>