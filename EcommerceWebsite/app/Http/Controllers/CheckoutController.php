<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'email'          => 'required|email',
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'country'        => 'required|string',
            'phone'          => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // If user selected Stripe
        if ($request->payment_method === 'payfast') {
            Stripe::setApiKey(config('services.stripe.secret'));

            $line_items = [];
            foreach ($cart as $item) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'pkr',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $item['price'] * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items'           => $line_items,
                'mode'                 => 'payment',
                'customer_email'       => $request->email,
                'metadata' => [
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'address'    => $request->address,
                    'city'       => $request->city,
                    'country'    => $request->country,
                    'phone'      => $request->phone,
                ],
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => route('stripe.cancel'),
            ]);

            return redirect($session->url);
        }

        // COD flow – create order immediately
        $order = $this->createOrder($cart, $request, 'cod');

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    // Stripe success callback
    public function stripeSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect('/')->with('error', 'Invalid session');
        }

        $session = Session::retrieve($sessionId);
        if ($session->payment_status !== 'paid') {
            return redirect('/')->with('error', 'Payment not completed');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Cart is empty!');
        }

        // Create order after successful Stripe payment
        $order = Order::create([
            'user_id'        => Auth::id(),
            'status'         => 'paid',
            'first_name'     => $session->metadata->first_name ?? 'Guest',
            'last_name'      => $session->metadata->last_name ?? '',
            'address'        => $session->metadata->address ?? '',
            'city'           => $session->metadata->city ?? '',
            'country'        => $session->metadata->country ?? '',
            'email'          => $session->customer_email ?? '',
            'phone'          => $session->metadata->phone ?? '',
            'subtotal'       => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'total'          => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'shipping'       => 0,
            'payment_method' => 'stripe',
        ]);

        foreach ($cart as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
            ]);

            Product::find($item['id'])?->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return view('layout_frontent.payment-success', compact('order'));
    }

    public function stripeCancel()
    {
        return view('payment-cancel');
    }

    // Helper function to create order
    private function createOrder($cart, $request, $payment_method)
    {
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id'        => Auth::id(),
            'status'         => $payment_method === 'cod' ? 'pending' : 'paid',
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'address'        => $request->address,
            'city'           => $request->city,
            'country'        => $request->country,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'subtotal'       => $subtotal,
            'total'          => $subtotal,
            'shipping'       => 0,
            'payment_method' => $payment_method,
        ]);

        foreach ($cart as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
            ]);

            Product::find($item['id'])?->decrement('stock', $item['quantity']);
        }

        return $order;
    }
}