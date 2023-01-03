<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
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

    public function create(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $orderData = [
                'order_status_id' => ACTIVE_STATUS,
                'payment_method_id' => $request->payment_method_id,
                'total_payment' => $request->total_payment,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'client_ip' => $request->client_ip,
                'note' => $request->order_note,
                'order_date' => now(),
                'store_id' => $request->order_items[0]['store_id'] ?? 1
            ];
            $order = $this->orderRepository->create($orderData);

            $storeIds = [];
            foreach ($request->order_items as $item) {
                $orderItemData = [
                    'order_id'        => $order->id,
                    'qty'             => $item['qty'],
                    'price'           => $item['price'],
                    'product_name'    => $item['product_name'],
                    'product_img_url' => $item['product_img_url'],
                    'note'            => $item['order_item_note']
                ];
                // Make sure 1 order only for 1 store.
                $storeId = $item['store_id'] ?? null;
                if (!in_array($storeId, $storeIds)) {
                    $storeIds[] = $storeId;
                }
                if (is_null($storeId) || count($storeIds) > 1) {
                    DB::rollBack();
                    return sendError(
                        'storeId is required, you have to make sure 1 order only for 1 store',
                        'Request was failed',
                        403
                    );
                }
                $orderItem = $this->orderItemRepository->create($orderItemData);
            }
            DB::commit();
            return sendResponse(
                [
                    'orderId' => $order->id,
                ],
                'Thành công'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return sendError($e->getMessage(), 500);
        }
    }
}
