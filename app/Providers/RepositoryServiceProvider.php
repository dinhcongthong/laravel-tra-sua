<?php

namespace App\Providers;
use App\Http\Repositories\Option\OptionRepository;
use App\Http\Repositories\Option\OptionRepositoryInterface;
use App\Http\Repositories\Option\OptionCategoryRepository;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Order\OrderRepository;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Repositories\OrderItem\OrderItemRepository;
use App\Http\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Http\Repositories\OrderStatus\OrderStatusRepository;
use App\Http\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use App\Http\Repositories\Product\ProductRepository;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\ProductOption\ProductOptionRepository;
use App\Http\Repositories\ProductOption\ProductOptionRepositoryInterface;
use App\Http\Repositories\Setting\PaymentMethod\PaymentMethodRepository;
use App\Http\Repositories\Setting\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Http\Repositories\Setting\System\SystemRepository;
use App\Http\Repositories\Setting\System\SystemRepositoryInterface;
use App\Http\Repositories\Store\StoreRepository;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Repositories\StoreStatus\StoreStatusRepository;
use App\Http\Repositories\StoreStatus\StoreStatusRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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

        $this->app->singleton(
            PaymentMethodRepositoryInterface::class,
            PaymentMethodRepository::class
        );

        $this->app->singleton(
            SystemRepositoryInterface::class,
            SystemRepository::class
        );

        $this->app->singleton(
            OptionRepositoryInterface::class,
            OptionRepository::class
        );

        $this->app->singleton(
            OptionCategoryRepositoryInterface::class,
            OptionCategoryRepository::class
        );

        $this->app->singleton(
            ProductOptionRepositoryInterface::class,
            ProductOptionRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
