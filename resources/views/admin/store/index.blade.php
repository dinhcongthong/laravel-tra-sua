@extends('layouts.admin')
@section('stylesheet')
@endsection
@section('content')
    <div class="page-title">
        <h3>Stores</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your store</p>
        <a href="{{ route('admin.stores.get_update') }}" class="btn btn-success mb-3 fw-bold">+ Add new</a>
        <div class="col-12 py-3">
            @if (isset($status))
                <div class="alert alert-light-danger color-danger my-2">
                    <p>{{ $status }}</p>
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
                            <th>ID</th>
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
                                <td>{{ $item->id }}</td>
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
                                        <i data-feather="edit" title="Edit"></i>
                                    </a>
                                    <a href="{{ route('admin.stores.delete', $item->id) }}"
                                        class="mx-2 store-delete" data-bs-toggle="modal"
                                        data-bs-target="#del_modal">
                                        <i class="text-danger" data-feather="trash-2" title="Delete"></i>
                                    </a>
                                    <a href="{{ route('admin.products.get_crawler', $item->id) }}">
                                        <i class="text-success" data-feather="cast" title="Crawl product from order websites"></i>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            storeDelete();
        });

        function storeDelete() {
            $('.store-delete').on('click', function(e) {
                $('#del_modal').modal('show');
                let url = $(this).attr('href');
                $('#btn_confirm').on('click', function(e) {
                    window.location.href = url;
                })
            })
        }
    </script>
@endsection
