@extends('layouts.admin')
@section('stylesheet')
    <style>
        #order_table tr:hover {
            cursor: pointer;
            transform: scale(1.03)
        }
        #order_table {
            overflow-x: auto;
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
                <div class="d-flex justify-content-between align-items-center mt-1">
                    <div>
                        <a href="#" class="btn btn-success"><span data-feather="plus" class="me-1"></span>Thêm mới</a>
                        <a href="#" class="btn btn-danger"><span data-feather="trash-2" class="me-1"></span>Xóa tất cả</a>
                    </div>
                    <form action="" method="get" style="width: 20%">
                        <div class="d-flex justify-content-end">
                            <input type="text" name="search" value="{{ Request()->search }}" class="form-control"
                                placeholder="Tìm kiếm tên đơn hàng">
                        </div>
                    </form>
                </div>
                <table class='table table-striped' id="order_table">
                    <thead>
                        <tr>
                            <th>NO</th>
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
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ number_format($order->total_payment) . ' đ' }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>
                                    <select name="order_status" class="form-control order-status"
                                        data-id="{{ $order->id }}">
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
                                <td class="order-detail p-0" data-id="{{ $order->id }}">
                                    <i class="text-success" data-feather="eye" title="Detail"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginator">
                    @if ($orders->count() > 0)
                        {{ $orders->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
        {{-- Modal --}}
        <div class="modal fade text-left" id="order_detail_modal" tabindex="-1" role="dialog" aria-labelledby="order_detail"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="order_detail">Chi tiết đơn đặt hàng</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2"><label class="fw-bold" for="buyer">Người mua hàng </label></div>
                            <div class="col-2"><p id="buyer"></p></div>
                            <div class="col-2"><label class="fw-bold" for="total_payment">Tổng tiền </label></div>
                            <div class="col-2"><p id="total_payment"></p></div>
                            <div class="col-2"><label class="fw-bold" for="phone">SĐT </label></div>
                            <div class="col-2"><p id="phone"></p></div>
                        </div>
                        <div class="row">
                            <div class="col-2"><label class="fw-bold" for="status">Trạng thái</label></div>
                            <div class="col-2"><span id="status" class="badge"></span></div>
                            <div class="col-2"><label class="fw-bold" for="note">Ghi chú</label></div>
                            <div class="col-2"><p id="note"></p></div>
                            <div class="col-2"><label class="fw-bold" for="order_date">Ngày đặt hàng </label></div>
                            <div class="col-2"><p id="order_date"></p></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"><label class="fw-bold" for="payment_method">Phương thức thanh toán </label></div>
                            <div class="col-3"><p id="payment_method"></p></div>
                            <div class="col-3"><label class="fw-bold" for="updated_at">Cập nhật gần đây nhất </label></div>
                            <div class="col-3"><p id="updated_at"></p></div>
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
    <script>
        $(function() {
            changeOrderStatus();
            getOrderDetail();
        });

        function changeOrderStatus() {
            $('.order-status').on('change', function() {
                let statusId = $(this).val();
                let orderId = $(this).data('id');
                console.log(statusId)
                console.log(orderId)
                $.ajax({
                        method: 'GET',
                        url: "{{ route('admin.orders.update_status') }}",
                        data: {
                            statusId,
                            orderId
                        },
                        beforeSend: function () {
                            rootLoader.show();
                        },
                        complete: function () {
                            rootLoader.hide();
                        }
                    })
                    .done(function(res) {
                        if (!res.success) {
                            toastr.error('Lỗi cmnr!');
                            return;
                        }
                        toastr.success(res.message)
                    })
                    .fail(function(xhr, status, errors) {
                        console.log(xhr)
                        console.log(status)
                        console.log(errors)
                    })
            })
        }

        function getOrderDetail() {
            $('.order-detail').on('click', function (e) {
                e.preventDefault();
                let orderId = $(this).data('id');
                let url = "{{ route('admin.orders.get_detail') }}"
                $.ajax({
                    url,
                    method: 'GET',
                    data: {
                        orderId
                    },
                    beforeSend: function() {
                        rootLoader.show();
                    },
                    complete: function () {
                        rootLoader.hide();
                    }
                })
                .done(function (res) {
                    console.log(res);
                    $('#buyer').text(res.data.customer_name)
                    $('#total_payment').text(res.data.total_payment)
                    $('#phone').text(res.data.customer_phone)
                    $('#status').text(res.data.get_status.name)
                    $('#status').addClass('bg-' + res.data.get_status.color_class)
                    $('#note').text(res.data.note)
                    $('#order_date').text(res.data.order_date)
                    $('#updated_at').text(res.data.updated_at)
                    $('#payment_method').text(res.data.get_payment_method.name)
                    $('#order_detail_modal').modal('show');
                    let html = '';
                    html += `<table class="table table-bordered" id="order_item_table">
                                <thead>
                                    <th>Sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Ghi chú</th>
                                </thead>
                                <tbody>`;
                    res.data.get_order_items.forEach((item) => {
                        html += `<tr>
                                    <td>
                                        <img src="${item.product_img_url}" alt="" width="100">
                                    </td>
                                    <td>${item.product_name}</td>
                                    <td>X${item.qty}</td>
                                    <td>${item.note}</td>
                                </tr>`
                            });
                    html += `</tbody></table>`;
                    $('.modal-body').append(html);
                    $("#order_detail_modal").on("hidden.bs.modal", function () {
                        $('#order_item_table').remove();
                    });

                })
                .fail(function (xhr, status, errors) {
                    console.log(xhr)
                    console.log(status)
                    console.log(errors)
                })
            });
        }
    </script>
@endsection
