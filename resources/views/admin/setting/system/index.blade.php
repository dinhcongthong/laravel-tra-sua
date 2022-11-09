@extends('layouts.admin')
@section('content')
    <div class="page-title">
        <h3>Cài đặt hệ thống</h3>
        <p class="text-subtitle text-muted">Cài đặt hệ thống của bạn ở đây</p>
        <div class="col-12 py-3">
            @include('layouts.notifications.admin_message')
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Danh sách các cấu hình cài đặt
            </div>
            <div class="card-body container">
                <div class="row">
                    <div class="col-12">
                        <label for="system_name">Tên hệ thống cửa hàng</label>
                        <input type="text" id="system_name" class="form-control"
                            value="{{ $system->system_name ?? old('system_name') }}">
                    </div>
                    <div class="col-12">
                        <label for="time_start_open">Thời gian mở</label>
                        <input type="date" id="time_start_open" name="time_start_open"
                            value="{{ $system->time_start_open ?? old('time_start_open') }}">
                    </div>
                    <div class="col-12">
                        <label for="time_end_open">Thời gian đóng</label>
                        <input type="date" id="time_end_open" name="time_end_open"
                            value="{{ $system->time_end_open ?? old('time_end_open') }}">
                    </div>
                    <div class="col-12">
                        <label for="status">Trạng thái</label>
                        <input type="date" id="status" name="status"
                            value="{{ $system->status ?? old('status') }}">
                    </div>
                    <div class="col-12 py-4">
                        <button type="submit" class="btn btn-success"><i feather-data="save"></i> Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
