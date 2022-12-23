<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Option\OptionCategoryRepositoryInterface;
use App\Http\Repositories\Product\ProductRepositoryInterface;
use App\Http\Repositories\Store\StoreRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    private $storeRepository;

    private $optionCategoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreRepositoryInterface $storeRepository,
        OptionCategoryRepositoryInterface $optionCategoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->optionCategoryRepository = $optionCategoryRepository;
    }

    public function detail ($productId) {
        $category = $this->optionCategoryRepository->getAll();
        $product = $this->productRepository->getDetail($productId);

        $data = [];
        if (!empty($product->getOptions)) {
            foreach ($category as $category) {
                $i = 0;
                foreach ($product->getOptions as $option) {
                    if ($category->id == $option->getOptionCategory->id) {
                        $data[$category->name][$i]['name'] = $option->name;
                        $data[$category->name][$i]['price'] = $option->pivot->price;
                        $i++;
                    }
                }
            }
        }
        return sendResponse($data, 'Thành công');
    }
}
