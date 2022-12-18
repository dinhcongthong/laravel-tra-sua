<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Order\OrderRepositoryInterface;
use App\Http\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Http\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;

    private $orderItemRepository;

    private $orderStatusRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function index(Request $request)
    {
        $searchData = $request->search ?? '';
        $statusId = $request->status_filter ?? '';
        $orders = $this->orderRepository->getByConditions($searchData, $statusId);
        $orderStatuses = $this->orderStatusRepository->getAll($searchData);

        return view('admin.order.index', [
            'orders' => $orders,
            'orderStatuses' => $orderStatuses
        ]);
    }

    public function update(Request $request, $id = 0)
    {
        return $request->all();
    }

    public function updateStatus (Request $request) {
        try {
            $orderId = $request->orderId;
            $statusId = $request->statusId;
            $order = $this->orderRepository->update($orderId, ['order_status_id' => $statusId]);
            return sendResponse(true, 'Cập nhật trạng thái thành cmn công');
        } catch (\Exception $e) {
            return sendError($e->getMessage(), 500);
        }
    }

    public function getDetail (Request $request) {
        $order = $this->orderRepository->getDetail($request->orderId);
        return sendResponse($order, 'Thành công');
    }

    public function updateDiscount (Request $request) {
        $orderIds = $request->orderIds;
        $totalDiscount = $request->totalDiscount;

        $result = $this->orderRepository->updateDiscount($orderIds, $totalDiscount);
        return sendResponse([], 'Thành công');
    }

    public function delete($id)
    {
        return $id;
    }
}
