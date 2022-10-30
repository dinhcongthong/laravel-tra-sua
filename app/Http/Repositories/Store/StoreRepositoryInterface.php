<?php
namespace App\Http\Repositories\Store;

use App\Http\Repositories\RepositoryInterface;

interface StoreRepositoryInterface extends RepositoryInterface
{
    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getModel();

    public function getAllBySearchData($searchData);

    public function getAllProductsBySearchData($searchData);

    public function getProducts($storeId);
}
