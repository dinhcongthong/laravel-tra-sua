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
}
