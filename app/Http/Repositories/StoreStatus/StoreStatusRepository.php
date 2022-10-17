<?php

namespace App\Http\Repositories\StoreStatus;

use App\Http\Repositories\BaseRepository;
use App\Models\Store;
use App\Models\StoreStatus;

class StoreStatusRepository extends BaseRepository implements StoreStatusRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return StoreStatus::class;
    }

    public function initStore() {
        return new StoreStatus();
    }
}
