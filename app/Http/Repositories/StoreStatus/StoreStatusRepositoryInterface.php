<?php
namespace App\Http\Repositories\StoreStatus;

use App\Http\Repositories\RepositoryInterface;

interface StoreStatusRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function initStore();
}
