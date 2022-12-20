@extends('layouts.admin')

@section('stylesheet')
    <style>
        .order-dashboard-table {
            font-size: 1rem;
        }
        .border-item {
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
    <div class="page-title">
        <h3>Thống kê</h3>
        <p class="text-subtitle text-muted">Đây là trang thống kê tổng doanh thu của bạn</p>
    </div>
    <section class="section">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>
                            Tổng doanh thu
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="pl-3">
                                    <h1 class='mt-5'>100,000,000 VND</h1>
                                    <p class='text-xs'><span class="text-green"><i data-feather="bar-chart"
                                                width="15"></i> +19%</span> so với tháng trước</p>
                                    <div class="legends">
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-info me-2'></div>
                                            <span class='text-xs'>Theo tuần</span>
                                        </div>
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-blue me-2'></div>
                                            <span class='text-xs'>Theo tháng</span>
                                        </div>
                                    </div>
                                </div>
                                <table class="table order-dashboard-table">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Đơn hàng hôm nay</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>Đơn hàng đang chờ xác nhận</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>Đơn hàng đã giao</td>
                                            <td>120</td>
                                        </tr>
                                        <tr>
                                            <td>Đơn hàng đã hủy</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8 col-12" id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/library/dashboard.js') }}"></script>
@endsection
