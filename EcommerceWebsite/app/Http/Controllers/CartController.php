<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
    
    
}
