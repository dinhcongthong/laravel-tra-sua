@extends('layouts.admin')

@section('content')
    <section class="section container">
        <div class="page-title text-center">
            <h3>Add new store</h3>
            <p class="text-subtitle text-muted">Let's add new your store here.</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-light-danger color-danger my-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.stores.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="py-3">
                <label for="">Nhập tên cửa hàng </label>
                <input type="text" name="name" class="form-control" value="{{ $store->name ?? old('name') }}" required>
            </div>
            <div class="py-3">
                <label for="">Nhập địa chỉ cửa hàng </label>
                <input type="text" name="address" class="form-control" value="{{ $store->address ?? old('address') }}"
                    required>
            </div>
            <div class="py-3">
                <label for="">Ghi chú </label>
                <input type="text" name="note" class="form-control" value="{{ $store->note ?? old('note') }}">
            </div>
            <div class="py-3">
                <select name="store_status_id" id="" class="select form-control" required>
                    <option>Vui lòng chọn một trạng thái</option>
                    @foreach ($storeStatus as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="py-3">
                <label for="">Vui lòng nhập hình ảnh cửa hàng</label>
                <input type="file" name="store_img" class="form-control" required>
                @if (!empty($store->getImage))
                    <div class="col-12 py-3">
                        <img src="{{ $store->getImage->url }}" alt="" width="100">
                    </div>
                @endif
            </div>
            <div class="text-center py-3">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </form>
    </section>
@endsection
