<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    private $storeRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
    }
}
