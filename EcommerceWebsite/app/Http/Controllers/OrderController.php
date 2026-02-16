<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        // $orders = Order::with('customer')->paginate(10);
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
}
