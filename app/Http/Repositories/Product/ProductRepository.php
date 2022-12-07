<?php

namespace App\Http\Repositories\Product;

use App\Models\Product;
use App\Http\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    public function crawlerGetByStoreIndex($storeId) {
        return $this->model->whereStoreId($storeId)->with('getImage', 'getStatus')->paginate(15);
    }

    public function getApiByStore ($storeId) {
        return $this->model
                    ->whereStoreId($storeId)
                    ->with('getImage')
                    ->with(['getProductOption' => function ($q) {
                        return $q->with('getOptionCategory');
                    }])
                    ->get(['id', 'name', 'description', 'gallery_id', 'price']);
    }

    public function getAllBySearchData($searchData) {
        return $this->model->orderBy('store_id', 'asc')
            ->with(['getStatus', 'getImage', 'getStore'])
            ->where('name', 'like', '%' . $searchData . '%')
            ->paginate(15);
    }
}
