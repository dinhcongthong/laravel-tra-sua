@extends('layouts.admin')
@section('stylesheet')
    <style>
        .order-detail:hover {
            cursor: pointer;
        }

        .modal-dialog {
            max-width: 1000px !important;
        }

        .paginator {
            padding-top: 1rem;
            display: flex;
            justify-content: center
        }
    </style>
@endsection
@section('content')
    <div class="page-title">
        <h3>Danh sách các đơn đặt hàng</h3>
        <p class="text-subtitle text-muted">Đây là trang danh sách các đơn đặt hàng của bạn</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="d-flex justify-content-end align-items-center mt-1">
                        <div class="d-flex justify-content-end">
                            <input type="text" name="search" value="{{ Request()->search }}" class="form-control"
                                placeholder="Tìm kiếm tên đơn hàng">
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <button class="btn btn-info me-3" type="button" id="btn_discount"
                            style="display: none;" onclick="makeDiscount()">
                            Giảm giá
                        </button>
                        <select name="status_filter" id="status_filter" class="form-control w-25">
                            <option value="">Lọc theo trạng thái</option>
                            @foreach ($orderStatuses as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == Request()->status_filter ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-warning ms-3"><i data-feather="filter"></i> Lọc</button>
                    </div>
                </form>
                <div style="overflow-y:hidden">
                    <table class='table table-responsive' id="order_table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input form-check-secondary"
                                            name="check_all_orders" id="check_all_orders">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Người mua</th>
                                <th>Tổng tiền</th>
                                <th>Phone</th>
                                <th>Trạng thái</th>
                                <th>Note</th>
                                <th>Ngày đặt</th>
                                <th>Đã cập nhật</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-check-secondary"
                                                name="order_checked[]" value="{{ $order->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->total_payment) . ' đ' }}</td>
                                    <td>{{ $order->customer_phone }}</td>
                                    <td>
                                        <select name="order_status" class="form-control order-status"
                                            data-id="{{ $order->id }}"
                                            data-url="{{ route('admin.orders.update_status') }}">
                                            @foreach ($orderStatuses as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $order->order_status_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td class="order-detail p-0" data-id="{{ $order->id }}"
                                        data-url="{{ route('admin.orders.get_detail') }}">
                                        <i class="text-success" data-feather="eye" title="Detail"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginator">
                    @if ($orders->count() > 0)
                        {{ $orders->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
        {{-- Modal --}}
        <div class="modal fade text-left" id="order_detail_modal" tabindex="-1" role="dialog"
            aria-labelledby="order_detail" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="order_detail">Chi tiết đơn đặt hàng #<span id="order_id"></span></h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2"><label class="fw-bold" for="buyer">Người mua hàng </label></div>
                            <div class="col-2">
                                <p id="buyer"></p>
                            </div>
                            <div class="col-2"><label class="fw-bold" for="order_date">Ngày đặt hàng </label></div>
                            <div class="col-2">
                                <p id="order_date"></p>
                            </div>
                            <div class="col-2"><label class="fw-bold" for="phone">Số điện thoại </label></div>
                            <div class="col-2">
                                <p id="phone"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2"><label class="fw-bold" for="status">Trạng thái</label></div>
                            <div class="col-3"><span id="status" class=""></span></div>
                            <div class="col-2"><label class="fw-bold" for="note">Ghi chú</label></div>
                            <div class="col-3">
                                <p id="note"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"><label class="fw-bold" for="payment_method">Phương thức thanh toán
                                </label>
                            </div>
                            <div class="col-3">
                                <p id="payment_method"></p>
                            </div>
                            <div class="col-3"><label class="fw-bold" for="updated_at">Cập nhật gần đây nhất </label>
                            </div>
                            <div class="col-3">
                                <p id="updated_at"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-2"><label class="fw-bold">Tổng tiền</label></div>
                            <div class="col-4 d-flex align-items-center">
                                <p id="total_payment" class="m-0"></p>
                                {{-- <input type="number" min="0" class="form-control" name="total_payment" id="total_payment" value=""> --}}
                                <a href="#" class="btn fw-bolder" id="save_total_payment" disabled><i
                                        data-feather="check"></i></a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/order.js') }}"></script>
@endsection
