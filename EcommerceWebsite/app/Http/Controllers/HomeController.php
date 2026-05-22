<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        // dd($product);
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

    public function shopall()
    {
        $product = Product::all()->where('is_active', true);
        return view('page.shopall', compact('product'));
    }

    // public function shopingcart($id)
    // {
    //     $product = Product::with('images')->findOrFail($id);

    //     $relatedProducts = Product::where('id', '!=', $id,)->where('is_active',true)->take(6)->get();

    //     return view('page.shopingcart', compact('product', 'relatedProducts'));
    // }
    public function shopingcart($id)
    {
        $product = Product::with(['images', 'attributes'])->findOrFail($id);
    
        // Initial value empty array ke bajaye empty Collection rakhein
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
