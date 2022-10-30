@extends('layouts.admin')

@section('content')
    <section class="section container bg-white p-5">
        <div class="page-title text-center">
            <h3>Update Product</h3>
            <p class="text-subtitle text-muted">{{ $store->name }}</p>
        </div>
        @if (isset($errors) && $errors->any())
            <div class="alert alert-light-danger color-danger my-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('message'))
            <div class="alert alert-light-success color-success my-2">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
        <form action="{{ route('admin.products.post_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id ?? null }}">
            <input type="hidden" name="crawl_id" value="{{ $product->crawl_id ?? null }}">
            <input type="hidden" name="store_id" value="{{ $store->id }}">
            <div class="py-3">
                <label for="">Nhập tên san pham </label>
                <input type="text" name="name" class="form-control" value="{{ $product->name ?? old('name') }}"
                    required>
            </div>
            <div class="py-3">
                <label for="">Nhập gia san pham </label>
                <input type="number" min="0" name="price" class="form-control" value="{{ $product->price ?? old('price') }}"
                    required>
            </div>
            <div class="py-3">
                <label for="">Nhập mo ta </label>
                <textarea name="description" class="form-control" id="description">{{ $product->description ?? old('description') }}</textarea>
            </div>
            <div class="py-3">
                <select name="product_status_id" id="" class="select form-control" required>
                    <option>Vui lòng chọn một trạng thái</option>
                    @foreach ($productStatus as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == optional($product)->product_status_id || $item->id == old('product_status_id') ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="py-3">
                <label for="">Vui lòng nhập hình ảnh san pham</label>
                <input type="file" name="product_img" id="product_img" class="form-control img-file">
                <div class="col-12 py-3">
                    @if (!empty($product->getImage))
                        <img src="{{ $product->getImage->url }}" class="img-preview" id="img_preview" alt="" width="200">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-preview" id="img_preview" width="200">
                    @endif
                </div>
            </div>
            <div class="text-center py-3">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </form>
    </section>
@endsection
