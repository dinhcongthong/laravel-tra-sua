<?php

namespace App\Http\Repositories\ProductOption;

use App\Models\ProductOption;
use App\Http\Repositories\BaseRepository;

class ProductOptionRepository extends BaseRepository implements ProductOptionRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ProductOption::class;
    }
}
