<?php
namespace App\Http\Repositories\ProductStatus;

use App\Http\Repositories\RepositoryInterface;

interface ProductStatusRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function initStore();
}
