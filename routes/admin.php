<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Product\CrawlerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Member\MemberController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\OptionController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Setting\PaymentMethodController;
use App\Http\Controllers\Admin\Setting\SystemController;
use App\Http\Controllers\Admin\Store\StoreController;
use Illuminate\Support\Facades\Auth;
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

// Home admin dashboard.
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('update/{storeId}/{productId?}', [ProductController::class, 'getUpdateFromStore'])->name('get_update_from_store');
    Route::post('update', [ProductController::class, 'postUpdate'])->name('post_update');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
    Route::get('crawler/{storeId?}', [CrawlerController::class, 'getCrawler'])->name('get_crawler');
    Route::post('post-crawler', [CrawlerController::class, 'postCrawler'])->name('post_crawler');

    Route::prefix('options')->name('options.')->group(function () {
        Route::get('/', [OptionController::class, 'index'])->name('index');
        Route::post('update-category/{id?}', [OptionController::class, 'postOptionCategory'])->name('post_option_category');
        Route::post('update/{id?}', [OptionController::class, 'postUpdateOption'])->name('post_option');
        Route::post('create/{id?}', [OptionController::class, 'postNewOption'])->name('post_new_option');

        Route::get('get-option-content/{optionCategoryId}/{productId}', [OptionController::class, 'getOptionContent']);
        Route::post('post-option-content/{productId}', [OptionController::class, 'postOptionContent']);
        Route::delete('category-delete/{categoryId}', [OptionController::class, 'categoryDelete'])->name('category_delete');
        Route::delete('delete/{optionId}', [OptionController::class, 'optionDelete'])->name('delete');
    });
});

Route::prefix('stores')->name('stores.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::get('/update/{id?}', [StoreController::class, 'getUpdate'])->name('get_update');
    Route::post('update', [StoreController::class, 'postUpdate'])->name('post_update');
    Route::delete('delete/{id}', [StoreController::class, 'delete'])->name('delete');
    Route::post('change-status', [StoreController::class, 'changeStatus'])->name('change_status');
});

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('get-detail', [OrderController::class, 'getDetail'])->name('get_detail');
    Route::match(['get', 'post'], 'update/{id?}', [OrderController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [OrderController::class, 'delete'])->name('delete');
    Route::get('update-status', [OrderController::class, 'updateStatus'])->name('update_status');
    Route::post('update-discount', [OrderController::class, 'updateDiscount'])->name('update_discount');
});

Route::prefix('members')->name('members.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('index');
    Route::get('update/{id?}', [MemberController::class, 'update'])->name('update');
});

Route::prefix('settings')->name('settings.')->group(function () {
    Route::prefix('payment-method')->name('payment.')->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
        Route::get('/update/{id?}', [PaymentMethodController::class, 'getUpdate'])->name('get_update');
        Route::post('/update', [PaymentMethodController::class, 'postUpdate'])->name('post_update');
    });
    Route::prefix('system')->name('system.')->group(function () {
        Route::match(['get', 'post'], '/', [SystemController::class, 'index'])->name('index');
    });
});
