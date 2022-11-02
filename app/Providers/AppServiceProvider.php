<?php

namespace App\Providers;

use App\Http\Repositories\Order\OrderRepository;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Repositories\OrderItem\OrderItemRepository;
use App\Http\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Http\Repositories\OrderStatus\OrderStatusRepository;
use App\Http\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use App\Http\Repositories\Product\ProductRepository;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepository;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Repositories\StoreStatus\StoreStatusRepository;
use App\Http\Repositories\StoreStatus\StoreStatusRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            StoreRepositoryInterface::class,
            StoreRepository::class
        );

        $this->app->singleton(
            StoreStatusRepositoryInterface::class,
            StoreStatusRepository::class
        );

        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderItemRepositoryInterface::class,
            OrderItemRepository::class
        );

        $this->app->singleton(
            OrderStatusRepositoryInterface::class,
            OrderStatusRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
