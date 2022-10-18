<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create/{storeId?}', [ProductController::class, 'getCreateFromStore'])->name('create_from_store');
    Route::post('update', [ProductController::class, 'postUpdate'])->name('update');
});

Route::prefix('stores')->name('stores.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::get('/update/{id?}', [StoreController::class, 'getUpdate'])->name('get_update');
    Route::post('update', [StoreController::class, 'postUpdate'])->name('post_update');
    Route::delete('delete/{id}', [StoreController::class, 'delete'])->name('delete');
});

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::match(['get', 'post'], 'update/{id?}', [OrderController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [OrderController::class, 'delete'])->name('delete');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('update/{id?}', [UserController::class, 'update'])->name('update');
});

Route::prefix('setting')->name('setting.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
});
