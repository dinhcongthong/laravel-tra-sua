<?php

namespace App\Http\Repositories\Product;

use App\Models\Product;
use App\Http\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    public function __construct () {

    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    /**
     * Get 5 Products hot in a month the last
     * @return mixed
     */
    public function getProductHost()
    {
        return $this->model::all();
    }
}
