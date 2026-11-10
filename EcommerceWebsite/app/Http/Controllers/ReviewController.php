<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product->reviews()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating' => $validated['rating'], 'comment' => $validated['comment'] ?? null]
        );

        return back()->with('review_success', 'Thank you! Your review has been submitted.');
    }
}
