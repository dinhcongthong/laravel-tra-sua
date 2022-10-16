<?php

namespace App\Http\Repositories\Store;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Store\StoreRepositoryInterface;
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

    /**
     * Get 5 Stores hot in a month the last
     * @return mixed
     */
    public function getStoreHost()
    {
        return $this->model::all();
    }

    public function getAll() {
        return $this->model->with(['getImage', 'getStatus'])->get();
    }

    public function initStore() {
        return new Store();
    }
}
