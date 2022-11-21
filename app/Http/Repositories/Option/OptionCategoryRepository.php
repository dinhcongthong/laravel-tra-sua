<?php

namespace App\Http\Repositories\Option;

use App\Models\OptionCategory;
use App\Http\Repositories\BaseRepository;

class OptionCategoryRepository extends BaseRepository implements OptionCategoryRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return OptionCategory::class;
    }
}
