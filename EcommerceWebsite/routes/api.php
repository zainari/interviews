<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Test\UserController;
Route::get('/search', [SearchController::class, 'search'])->name('api.search');

Route::get('/shop', [ShopController::class, 'index']);

Route::get('get_all_user', [UserController::class,'index']);

Route::get('getuser/{id}',[UserController::class,'userget']);

Route::post('user-create',[UserController::class,'usercreate']);

Route::get('/users/{id}', [UserController::class, 'destroy']);