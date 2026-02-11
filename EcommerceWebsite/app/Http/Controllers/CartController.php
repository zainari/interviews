<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('page.cart', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_url,
                'quantity' => $request->quantity ?? 1,
                // optionally: 'color' => $request->color  if you support variants
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    public function getCartData()
    {
        $cart = session('cart', []);
        return response()->json(['cart' => $cart]);
    }
    
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);
    
        if(isset($cart[$id])) {
    
            // decrease quantity by 1
            $cart[$id]['quantity'] -= 1;
    
            // if quantity becomes 0 → remove product fully
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }
    
        session()->put('cart', $cart);
    
        return response()->json(['cart' => $cart]);
    }
    
    public function checkoutform() {
        $cart = session('cart', []);
        
        // Calculate total and discount
        $total = 0;
        $discount = 0; // agar coupon/discount logic ho
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    
        return view('layout_frontent.checkoutform', compact('cart', 'total', 'discount'));
    }

    public function success($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);
        return view('layout_frontent.checkout_success', compact('order'));
    }

    

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
    
        // Get cart
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }
    
        // Calculate subtotal
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    
        // Create order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'status'         => 'pending',
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
            'payment_method' => $request->payment_method,
        ]);

        // dd($order);
    
        // Attach products to pivot
        foreach ($cart as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
            ]);
    
            Product::find($item['id'])?->decrement('stock', $item['quantity']);
        }
    
        // Clear cart
        session()->forget('cart');
    
        // Redirect to success page
        return redirect()->route('checkout.success', $order->id);
    }
    
    
}
