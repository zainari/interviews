<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('page.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status'  => 'guest',
                'message' => 'Please login to use wishlist.'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            $status = 'added';
        }

        $count = Wishlist::where('user_id', Auth::id())->count();

        return response()->json([
            'status'  => $status,
            'count'   => $count,
            'message' => $status === 'added' ? 'Added to wishlist!' : 'Removed from wishlist!',
        ]);
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Removed from wishlist!');
    }
}