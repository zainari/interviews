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
        return view('page.home',compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('page.productpages', compact('product'));
    }
}
