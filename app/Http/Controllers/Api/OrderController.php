<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const ACTIVE_STATUS = 1;
    private $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function getHistoryByIds (Request $request) {
        $orderIds = $request->order_ids;
        $orders = $this->orderRepository->getHistoryByIds($orderIds);

        return response()->json(['orders' => $orders]);
    }

    public function create (OrderRequest $request) {
        $data = [
            'order_status_id' => self::ACTIVE_STATUS,
            'total_payment' => $request->total_payment,
            'cus_name' => $request->cus_name,
            'cus_phone' => $request->cus_phone,
            'product_name' => $request->product_name,
            'client_ip' => $request->client_ip,
            'note' => $request->note,
            'order_date' => now()
        ];
        $order = $this->orderRepository->create($data);
        if ($order) {
            return response()->json([
                'orderId' => $order->id,
                'message' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'Have errors when processing order'
        ], 500);
    }
}
