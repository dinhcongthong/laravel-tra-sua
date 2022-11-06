<?php
namespace App\Http\Repositories\OrderStatus;

use App\Http\Repositories\RepositoryInterface;

interface OrderStatusRepositoryInterface extends RepositoryInterface
{
    public function getModel();
}
