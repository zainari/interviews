<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('page.home', compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('page.productpages', compact('product'));
    }

    public function homenew()
    {
        $product = Product::all()->where('is_active', true);
        return view('page.home_new', compact('product'));
    }

    /**
     * Handles the "Shop All" view and applies search query filters
     */
    public function shopall(Request $request)
    {
        // 1. Start an Eloquent query builder instance on active products
        $query = Product::where('is_active', true);

        // 2. Check if a search term is submitted in the URL
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            
            // Filter products matching name, brand, or description
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // 3. Execute the query to get the filtered products list
        $product = $query->get();

        // 4. Pass the filtered products to your shopall blade view
        return view('page.shopall', compact('product'));
    }

    public function shopingcart($id)
    {
        $product = Product::with(['images', 'attributes'])->findOrFail($id);

        $variants = collect();

        if ($product->color_group_id) {
            $variants = Product::where('color_group_id', $product->color_group_id)
                ->where('is_active', 1)
                ->get();
        }

        $relatedProducts = Product::where('id', '!=', $id)->take(6)->get();

        return view('page.shopingcart', compact('product', 'variants', 'relatedProducts'));
    }
}