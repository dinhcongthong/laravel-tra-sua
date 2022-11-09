@extends('layouts.admin')
@section('stylesheet')
@endsection
@section('content')
    <div class="page-title">
        <h3>Cài đặt phương thức thanh toán</h3>
        <p class="text-subtitle text-muted">Cài đặt phương thức thanh toán của bạn ở đây</p>
        <div class="col-12 py-3">
            @include('layouts.notifications.admin_message')
        </div>
        <div class="row py-3">
            <div class="col-2">
                <a class="btn btn-success" href="{{ route('admin.settings.payment.get_update') }}">
                    <i data-feather="file-plus"></i> Thêm mới
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Danh sách các phương thức thanh toán
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="py-3 d-flex justify-content-end">
                        <input type="text" name="search" value="{{ Request()->search }}"
                            class="form-control w-25" placeholder="Tìm kiếm phương thức thanh toán">
                    </div>
                </form>
                <table class='table' id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Tên</th>
                            <th>Ngày đăng ký</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentMethods as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ $item->getImage->url }}" alt="" width="100">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->status }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.settings.payment.get_update', $item->id) }}">
                                        <i data-feather="edit" title="Edit payment method"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
