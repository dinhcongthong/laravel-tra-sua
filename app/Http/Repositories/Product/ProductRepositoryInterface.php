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

    public function crawlerGetByStoreIndex($storeId);

    public function getAllBySearchData ($searchData);

    public function findDetail($id);

    public function getDetail ($id);
}
