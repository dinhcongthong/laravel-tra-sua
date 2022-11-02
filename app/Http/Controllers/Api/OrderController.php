<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const ACTIVE_STATUS = 1;

    private $orderRepository;

    private $orderItemRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getHistoryByIds(Request $request)
    {
        $orderIds = $request->order_ids;
        $orders = $this->orderRepository->getHistoryByIds($orderIds);

        return response()->json(['orders' => $orders]);
    }

    /**
     * api example
     * {
     *       "total_payment": 100000,
     *       "customer_name": "Thomas",
     *       "customer_phone": "0923492349",
     *       "client_ip": "192.168.1.1",
     *       "order_note": "ko co gi",
     *       "order_items" : [
     *           {
     *               "qty": 1,
     *               "price": 50000,
     *               "product_name": "Tra sua chan trau",
     *               "product_img_url": "https://abc.xyz",
     *               "order_item_note": "size S nha"
     *           },
     *           {
     *               "qty": 1,
     *               "price": 50000,
     *               "product_name": "Sua chua",
     *               "product_img_url": "https://abc.xyz",
     *               "order_item_note": "size M"
     *           }
     *       ]
     *   }
     */
    public function create(OrderRequest $request)
    {
        try {
            $orderData = [
                'order_status_id' => self::ACTIVE_STATUS,
                'payment_method_id' => 1,
                'total_payment' => $request->total_payment,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'client_ip' => $request->client_ip,
                'note' => $request->order_note,
                'order_date' => now()
            ];

            $order = $this->orderRepository->create($orderData);

            foreach ($request->order_items as $item) {
                $orderItemData = [
                    'order_id'        => $order->id,
                    'qty'             => $item['qty'],
                    'price'           => $item['price'],
                    'product_name'    => $item['product_name'],
                    'product_img_url' => $item['product_img_url'],
                    'note'            => $item['order_item_note']
                ];
                $orderItem = $this->orderItemRepository->create($orderItemData);
            }
            return sendResponse(
                [
                    'orderId' => $order->id,
                ],
                'Thành công'
            );
        } catch (\Exception $e) {
            return sendError($e->getMessage(), 500);
        }
    }
}
