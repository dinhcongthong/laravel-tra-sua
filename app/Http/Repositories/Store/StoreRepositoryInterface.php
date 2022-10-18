<?php
namespace App\Http\Repositories\Store;

interface StoreRepositoryInterface
{
    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getModel();

    public function getAllBySearchData($searchData);

    public function find($id);

    public function findOrFail($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function getProducts($storeId);
}
