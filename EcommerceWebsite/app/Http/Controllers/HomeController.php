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

    public function homenew(){
        $product = Product::all();
        // dd($product);
        return view('page.home_new',compact('product'));
    }

    public function shopall(){
        $product = Product::all();
        // dd($product);
        return view('page.shopall',compact('product'));
    }

    public function shopingcart($id){
        $product = Product::findOrFail($id); // Corrected spelling
        // dd($product);
        return view('page.shopingcart', compact('product')); // Make sure view name is same as file
    }

}
