<?php

namespace App\Http\Repositories\Option;

use App\Models\Option;
use App\Http\Repositories\BaseRepository;

class OptionRepository extends BaseRepository implements OptionRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Option::class;
    }

    public function getOptionContent ($optionCategoryId, $productId) {
        $options = $this->model->where('option_category_id', $optionCategoryId)
                        ->with(['getProductOptions' => function ($q) use ($productId) {
                            return $q->where('product_id', $productId);
                        }])
                        ->get();
        return $options;
    }
}
