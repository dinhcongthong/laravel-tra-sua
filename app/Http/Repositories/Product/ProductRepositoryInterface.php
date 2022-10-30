<?php
namespace App\Http\Repositories\Product;

use App\Http\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    /**
     * Set model
     */
    public function setModel();

    /**
     * @param $store_id
     */
    public function getByStore($storeId);

    public function getAllBySearchData ($searchData);
}
