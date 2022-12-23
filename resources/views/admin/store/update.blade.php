@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="card container">
            <div class="card-header text-dark text-center">
                <h3>Cập nhật {{ $store->name ?? 'cửa hàng' }}</h3>
                <p class="text-subtitle text-muted">Hãy cập nhật cửa hàng của bạn ở đây</p>
            </div>
            <div class="card-body">
                @include('layouts.notifications.admin_message')
                <form action="{{ route('admin.stores.post_update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="store_id" value="{{ $store->id ?? null }}">
                    <div class="py-3">
                        <label for="">Nhập tên cửa hàng </label>
                        <input type="text" name="name" class="form-control" value="{{ $store->name ?? old('name') }}"
                            required>
                    </div>
                    <div class="py-3">
                        <label for="">Nhập địa chỉ cửa hàng </label>
                        <input type="text" name="address" class="form-control"
                            value="{{ $store->address ?? old('address') }}" required>
                    </div>
                    <div class="py-3">
                        <label for="">Mô tả </label>
                        <input type="text" name="note" class="form-control" value="{{ $store->note ?? old('note') }}" required>
                    </div>
                    <div class="py-3">
                        <select name="store_status_id" id="" class="select form-control" required>
                            <option>Vui lòng chọn một trạng thái</option>
                            @foreach ($statuses as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == optional($store)->store_status_id || $item->id == old('store_status_id') ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-3">
                        <label for="">Vui lòng nhập hình ảnh cửa hàng</label>
                        <input type="file" name="store_img" id="store_img" class="form-control img-file">
                        <div class="col-12 py-3">
                            @if (!empty($store->getImage))
                                <img src="{{ $store->getImage->url }}" class="img-preview" id="img_preview" alt=""
                                    width="200">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-preview"
                                    id="img_preview" width="200">
                            @endif
                        </div>
                    </div>
                    <div class="text-center py-3">
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
