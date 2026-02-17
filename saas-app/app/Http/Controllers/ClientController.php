<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        // Global scope ki wajah se ye sirf current company ke clients layega
        $clients = Client::all(); 
        return view('clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
        ]);

        // company_id khud hi assign ho jayegi Model ke 'booted' method se
        Client::create($request->all());

        return redirect()->back()->with('success', 'Client added successfully!');
    }
}