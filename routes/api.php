<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SystemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [HomeController::class, 'index']);

Route::prefix('product')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('detail/{id}', [ProductController::class, 'detail']);
});

Route::prefix('order')->name('order.')->group(function () {
    Route::post('create', [OrderController::class, 'create']);
    Route::get('history', [OrderController::class, 'getHistoryByIds']);
});

Route::prefix('payment-methods')->name('payment-methods.')->group(function () {
    Route::get('/', [PaymentController::class, 'getPaymentMethodActive']);
});

Route::prefix('system')->name('system.')->group(function () {
    Route::get('/', [SystemController::class, 'index']);
});
