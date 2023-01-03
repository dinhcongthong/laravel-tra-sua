<?php

namespace App\Http\Repositories\Order;

use App\Models\Order;
use App\Http\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface {
    public function __construct () {
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Order::class;
    }

    public function getHistoryByIds ($orderIds) {
        return $this->model->whereIn('id', $orderIds)
        ->with(['getOrderItems:id,order_id,qty,price,product_name,product_img_url,note', 'getStatus:id,name,color_class'])
        ->with(['getPaymentMethod' => function ($q) {
            $q->select('id', 'name', 'gallery_id')->with('getImage');
        }])
        ->paginate(15);
    }

    public function getAll() {
        return $this->model->with(['getOrderItems', 'getPaymentMethod', 'getStatus'])->get();
    }

    public function getDetail ($orderId) {
        return $this->model->with(['getOrderItems', 'getPaymentMethod', 'getStatus'])->whereId($orderId)->firstOrFail();
    }

    public function getByConditions ($searchData, $statusId) {
        $query = $this->model->with(['getOrderItems', 'getPaymentMethod', 'getStatus']);
        if (!empty($statusId)) {
            $query = $query->where('order_status_id', $statusId);
        }
        if (!empty($searchData)) {
            $query = $query->whereId($searchData)
                            ->orWhere('total_payment', 'like', '%' . $searchData . '%')
                            ->orWhere('customer_name', 'like', '%' . $searchData . '%')
                            ->orWhere('customer_phone', 'like', '%' . $searchData . '%')
                            ->orWhere('order_date', 'like', '%' . $searchData . '%');
        }
        return $query->paginate(20);
    }

    public function updateDiscount(array $orderIds, $totalDiscount) {
        try {
            $result = $this->model->whereIn('id', $orderIds)->update(['discount' => $totalDiscount]);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
