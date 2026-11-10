<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('products')->orderBy('created_at', 'desc')->paginate(8);
        $wishlistCount = $user->wishlists()->count();

        return view('page.account', compact('user', 'orders', 'wishlistCount'));
    }
}
