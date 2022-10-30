<?php

namespace App\Http\Repositories\ProductStatus;

use App\Http\Repositories\BaseRepository;;
use App\Models\ProductStatus;

class ProductStatusRepository extends BaseRepository implements ProductStatusRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ProductStatus::class;
    }

    public function initStore() {
        return new ProductStatus();
    }
}
