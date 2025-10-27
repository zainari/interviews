<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page/home');
});

Route::get('/product', function () {
    return view('layout_frontent/product');
});

Route::get('/cart', function () {
    return view('layout_frontent/checkoutform');
});

Route::get('/chatbot', function () {
    return view('layout_frontent/chatbot');
});

Route::get('/about', function () {
    return view('layout_frontent/about');
});

Route::get('/home', function () {
    return view('page/home');
});

Route::get('/aboutpage', function () {
    return view('page/about');
});

Route::get('/contact', function () {
    return view('page/contact');
});

Route::get('/product', function () {
    return view('page/product');
});