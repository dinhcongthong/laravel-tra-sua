@extends('layouts.admin')
@section('stylesheet')
@endsection
@section('content')
    <div class="page-title">
        <h3>Stores</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your store</p>
        <a href="{{ route('admin.stores.get_update') }}" class="btn btn-success mb-3 fw-bold">+ Add new</a>
        <div class="col-12 py-3">
            @include('layouts.notifications.admin_message')
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
                        <input type="text" name="search" value="{{ Request()->search }}" class="form-control w-25"
                            placeholder="Tìm kiếm tên cửa hàng">
                    </div>
                </form>
                <table class='table' id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Image</th>
                            <th>Hành động</th>
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
                                    <select name="store_status" id="store_status" onchange="changeStatus(`{{ $item->id }}`, $(this))"
                                        class="form-control text-white {{ $item->getStatus->color_class }}">
                                        @foreach ($statuses as $status)
                                            <option
                                                value="{{ $status->id }}"{{ $status->id == $item->store_status_id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
@section('scripts')
    <script>
        var changeStatus = (storeId, element) => {
            statusId = $(element).val();
            $.ajax({
                url: "{{ route('admin.stores.change_status') }}",
                method: 'POST',
                data: {
                    storeId,
                    statusId
                },
                beforeSend: () => {
                    rootLoader.show();
                },
                error: () => {
                    rootLoader.hide();
                    toastr.err('Lỗi cmnr');
                }
            })
            .done((response) => {
                console.log(response);
                rootLoader.hide();
                $(element).removeClass();
                $(element).addClass(response.data.color_class + ' form-control text-white');
                toastr.success('Cập nhật thành công');
            })
        }
    </script>
@endsection
