@extends('layouts.admin')
@section('stylesheet')
    <style>
        input#status {
            font-size: 1.5rem;
        }
        .col-6:has(.form-switch) {
            padding-left: 2.2rem;
        }
        .save-icon {
            position: relative;
            top: -2px;
        }
    </style>
@endsection
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
                <form action="" method="POST">
                    @csrf
                    <div class="row w-50 m-auto align-items-center">
                        <div class="col-4 py-3">
                            <label for="system_name">Tên hệ thống cửa hàng</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="system_name" name="system_name" class="form-control"
                                value="{{ $system->system_name ?? old('system_name') }}">
                        </div>
                        <div class="col-4 py-3">
                            <label for="time_start_open">Thời gian mở</label>
                        </div>
                        <div class="col-6">
                            <input type="time" id="time_start_open" name="time_start_open" class="form-control"
                                value="{{ $system->time_start_open ?? old('time_start_open') }}">
                        </div>
                        <div class="col-4 py-3">
                            <label for="time_end_open">Thời gian đóng</label>
                        </div>
                        <div class="col-6">
                            <input type="time" id="time_end_open" name="time_end_open" class="form-control"
                                value="{{ $system->time_end_open ?? old('time_end_open') }}">
                        </div>
                        <div class="col-4 py-3">
                            <label for="status">Trạng thái</label>
                        </div>
                        <div class="col-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-secondary" type="checkbox" name="status" id="status" value="1" {{ $system->status == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-10 py-5 text-center">
                            <button type="submit" class="btn btn-success"><i data-feather="save" class="save-icon"></i> Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
