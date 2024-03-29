<?php
namespace App\Http\Repositories\Order;

use App\Http\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    public function getHistoryByIds($orderIds);

    public function getDetail($orderId);

    public function getByConditions($searchData, $statusId);

    public function updateDiscount(array $orderIds, $totalDiscount);
}
