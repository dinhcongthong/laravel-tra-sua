<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function index(Request $request)
    {
        $storeId = $request->storeId;
        $searchData = $request->search;
        $productFromStore = [];
        if (is_null($storeId)) {
            $productFromStore = $this->storeRepository->getAllProductsBySearchData($searchData);
        } else {
            $productFromStore = $this->productRepository->getApiByStore($storeId);
        }
        return sendResponse(
            [
                'products' => $productFromStore
            ],
            'Thành công'
        );
    }
}
