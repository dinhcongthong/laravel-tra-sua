@extends('layouts.admin')
@section('stylesheet')
<style>
    .order-detail:hover {
        cursor: pointer;
        transform: scaleZ()
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
            <div class="card-header">
                Danh sách các đơn hàng
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="py-3 d-flex justify-content-end">
                        <input type="text" name="search" value="{{ Request()->search }}" class="form-control w-25"
                            placeholder="Tìm kiếm tên đơn hàng">
                    </div>
                </form>
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Người mua</th>
                            <th>Phương thức thanh toán</th>
                            <th>Phone</th>
                            <th>Trạng thái</th>
                            <th>Note</th>
                            <th>Ngày đặt</th>
                            <th>Đã cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="order-detail" data-id="{{ $order->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->getPaymentMethod->name }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            changeOrderStatus();
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
                    })
                    .done(function(res) {
                        if (res.success) {
                            toastr.success(res.message, {
                                timeOut: 99999
                            });
                        }
                    })
                    .fail(function(xhr, status, errors) {
                        console.log(xhr)
                        console.log(status)
                        console.log(errors)
                    })
            })
        }
    </script>
@endsection
