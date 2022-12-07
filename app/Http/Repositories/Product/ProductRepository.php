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

    public function getByStore ($storeId) {
        return $this->model->whereStoreId($storeId)->with('getImage')->get();
    }

    public function getAllBySearchData($searchData) {
        return $this->model->orderBy('store_id', 'asc')
            ->with(['getStatus', 'getImage', 'getStore'])
            ->where('name', 'like', '%' . $searchData . '%')
            ->paginate(15);
    }
}
