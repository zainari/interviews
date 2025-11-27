<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\UserController;
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

// Route::get('/addproduct', function () {
//     return view('admin.products.form');
// });



// Category Routes

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/store-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('create-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('update-category/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Product Routes

Route::get('products',[ProductController::class,'index'])->name('products.index');
Route::get('create-product',[ProductController::class,'create'])->name('products.create');
Route::post('store-product',[ProductController::class,'store'])->name('products.store');
Route::get('edit-product/{product}',[ProductController::class,'edit'])->name('products.edit');
Route::post('update-product/{product}',[ProductController::class,'update'])->name('products.update');
Route::get('delete-product/{product}',[ProductController::class,'destroy'])->name('products.destroy');

// Attribute Routes
Route::get('attributes', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('create-attribute', [AttributeController::class, 'create'])->name('attributes.create');
Route::post('store-attribute', [AttributeController::class, 'store'])->name('attributes.store');
Route::get('edit-attribute/{attribute}', [AttributeController::class, 'edit'])->name('attributes.edit');
Route::post('update-attribute/{attribute}', [AttributeController::class, 'update'])->name('attributes.update');
Route::get('delete-attribute/{attribute}', [AttributeController::class, 'destroy'])->name('attributes.destroy');


// Attribute Value

Route::get('attribute-value-index',[AttributeValueController::class,'index'])->name('attributes-value.index');
Route::get('attribute-value-create',[AttributeValueController::class,'create'])->name('attribute-value-create');
Route::post('attribute-value-store',[AttributeValueController::class,'store'])->name('attribute-value-store');
Route::get('attribute-value-edit/{attributeValue}', [AttributeValueController::class, 'edit'])->name('attribute-value-edit');
Route::put('attribute-value-update/{attributeValue}', [AttributeValueController::class, 'update'])->name('attribute-value-update');
Route::delete('attribute-value-delete/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('attribute-value-destroy');


// Chatbot Routes

// Route::get('/chatbot', function () {
//     return view('chatbot');
// });
Route::get('/chatbot', [ChatbotController::class, 'index']);
Route::post('/chatbot/send', [ChatbotController::class, 'send'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/chatbot/train', [ChatbotController::class, 'train'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
// Route::post('/chatbot/send', [ChatbotController::class, 'send']);

// User Login Register Page
Route::get('/login', [UserController::class, 'index'])->name('user.loginpage');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::get('/showregister', [UserController::class, 'showRegisterForm'])->name('user.showregisterform');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
