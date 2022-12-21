<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use App\Http\Resources\StoreResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

        $data = $this->storeRepository->getApiProducts($storeId, $searchData);
        $data = $storeId ? new StoreResource($data) : StoreResource::collection($data);
        return sendResponse($data, 'Thành công');
    }
}
