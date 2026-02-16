<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentIntentController extends Controller
{
public function createPaymentIntent()
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 5000, // 50.00 USD
        'currency' => 'usd',
    ]);

    return response()->json($paymentIntent);
}
}
