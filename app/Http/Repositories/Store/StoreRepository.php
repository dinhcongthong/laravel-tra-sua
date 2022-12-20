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
        return $this->model->with(['getImage', 'getStatus'])
            ->where('name', 'like', '%' . $searchData . '%')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getAllProductsBySearchData($searchData) {
        return $this->model->whereStoreStatusId(ACTIVE_STATUS)
            ->with(['getImage', 'getStatus'])
            ->with(['getProducts' => function ($q) {
                return $q->with('getImage');
            }])
            ->where('name', 'like', '%' . $searchData . '%')
            ->paginate(5);
    }

    public function getProducts($storeId)
    {
        $store = $this->model->with(['getProducts'])->find($storeId);
        return $store;
    }
}
