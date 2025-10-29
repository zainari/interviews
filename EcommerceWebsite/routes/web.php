<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/dashboard', function () {
    return view('admin/dashboard');
});


Route::get('/setting', function () {
    return view('admin/product');
});

Route::get('/addproduct', function () {
    return view('admin.products.form');
});



// Category Routes

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/store-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('create-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('update-category/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');