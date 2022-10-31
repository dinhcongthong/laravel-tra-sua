<?php
namespace App\Http\Repositories\OrderItem;

use App\Http\Repositories\RepositoryInterface;

interface OrderItemRepositoryInterface extends RepositoryInterface
{
    public function getModel();

}
