<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use App\PaymentResolver\PaymentResolve;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $paymentResolve;

    /**
     * Create a new payment method instance.
     *
     * @return void
     */
    public function __construct(PaymentResolve $paymentResolve)
    {
        $this->paymentResolve = $paymentResolve;
    }

    public function payment(Request $request){

        //do the database transaction

        $course = Course::findOrFail($request->course_id);

        if($course->students()->wherePivot('user_id', auth()->id())->first()){
            return redirect()->route('welcome')->with('success', 'Already Purchase');
        }
        else if(auth()->user()->user_type == 'admin'){
           // return redirect()->route('welcome')->with('success', 'You are admin');
        }

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'course_id' => $request->course_id,
            'total_amount' => $course->price,
            'transaction_id' => auth()->id() . time() . uniqid(mt_rand(), true),
            'payment_method' => $request->payment_method,
            'currency' => 'USD',
            'payment_details' => NULL,
            'payment_time' => now(),
            'status' => 'INITIATE',
        ]);

        $request->total_amount = $course->price;
        $paymentProvider = $this->paymentResolve->resolvePayment($request->payment_method);
        session()->put('payment_method', $request->payment_method);
        session()->put('transaction_id', $transaction->transaction_id);

        return $paymentProvider->handlePayment($request);
    }

    public function success(Request $request)
    {
        if (session()->has('payment_method')) {
            $paymentProvider = $this->paymentResolve->resolvePayment(session()->get('payment_method'));

            return $paymentProvider->success($request);
        }
    }

    public function cancelled(Request $request)
    {
        if ($request->isMethod('POST') && session()->has('payment_method')) {

            $paymentProvider = $this->paymentResolve->resolvePayment(session()->get('payment_method'));

            return $paymentProvider->cancel();
        }
    }
}
