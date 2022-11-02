@extends('layouts.admin')
@section('stylesheet')
@endsection
@section('content')
    <div class="page-title">
        <h3>Stores</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your store</p>
        <a href="{{ route('admin.stores.get_update') }}" class="btn btn-success mb-3 fw-bold">+ Add new</a>
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
                Danh sách các cửa hàng
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
                        @foreach ($stores as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->note }}</td>
                                <td>
                                    <span class="badge {{ $item->getStatus->color_class }}">
                                        {{ $item->getStatus->name }}
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ $item->getImage->url }}" width="80" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('admin.stores.get_update', $item->id) }}">
                                        <i data-feather="edit" title="Edit store"></i>
                                    </a>
                                    <a href="{{ route('admin.products.get_crawler', $item->id) }}">
                                        <i class="text-warning" data-feather="eye" title="Detail"></i>
                                    </a>
                                    <a href="{{ route('admin.products.get_update_from_store', $item->id) }}">
                                        <i class="text-success" data-feather="file-plus" title="Add product from store"></i>
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
