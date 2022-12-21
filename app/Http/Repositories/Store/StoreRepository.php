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
            ->with(['getImage:id,url', 'getStatus:id,name'])
            ->with(['getProducts' => function ($q) use ($searchData) {
                return $q->with(['getImage:id,url'])->where('name', 'like', '%' . $searchData . '%');
            }])
            ->paginate(5);
    }

    public function getProducts ($storeId) {
        return $this->model->with(['getProducts'])->find($storeId);
    }

    public function getApiProducts($storeId, $searchData)
    {
        $store = $this->model
            ->with(['getProducts' => function ($q) use ($searchData) {
                $rs = $q->with(['getStatus:id,name', 'getImage:id,url']);
                if (!is_null($searchData)) {
                    $rs = $rs->where('name', 'like', '%' . $searchData . '%');
                }
                return $rs;
            }])
            ->with(['getImage:id,url', 'getStatus:id,name']);

        $store = $storeId ? $store->find($storeId) : $store->get();
        return $store;
    }
}
