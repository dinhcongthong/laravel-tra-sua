<?php

namespace App\Http\Repositories\Store;

use App\Http\Repositories\BaseRepository;
use App\Models\Store;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Store::class;
    }

    public function getAllBySearchData($searchData) {
        return $this->model->with(['getImage', 'getStatus'])->where('name', 'like', '%' . $searchData . '%')->get();
    }
}
