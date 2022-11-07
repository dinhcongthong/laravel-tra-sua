@extends('layouts.admin')
@section('stylesheet')
@endsection
@section('content')
    <div class="page-title">
        <h3>Cài đặt phương thức thanh toán</h3>
        <p class="text-subtitle text-muted">Cài đặt phương thức thanh toán của bạn ở đây</p>
        <div class="col-12 py-3">
            @if (Session::has('message'))
                <div class="alert alert-light-success color-success my-2">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
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
                            class="form-control w-25" placeholder="Tìm kiếm tên cửa hàng">
                    </div>
                </form>
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
