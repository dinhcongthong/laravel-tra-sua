@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="card container">
            <div class="card-header">
                <h3 class="text-dark text-center">Cập nhật {{ $store->name }}</h3>
            </div>
            <div class="card-body">
                @include('layouts.notifications.admin_message')

                <form action="{{ route('admin.products.post_update') }}" method="post" enctype="multipart/form-data"
                    id="product_form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id ?? null }}">
                    <input type="hidden" name="crawl_id" value="{{ $product->crawl_id ?? null }}">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="row py-3">
                        <div class="col-12 col-md-6">
                            <label for="">Nhập tên sản phẩm </label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $product->name ?? old('name') }}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="">Nhập giá sản phẩm </label>
                            <input type="number" min="0" name="price" class="form-control"
                                value="{{ $product->price ?? old('price') }}" required>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-12 col-md-6">
                            <label for="">Nhập mô tả </label>
                            <textarea name="description" class="form-control" id="description">{{ $product->description ?? old('description') }}</textarea>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="">Trạng thái</label>
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
                    </div>
                    <div class="row py-3">
                        <div class="col-12 col-md-6">
                            <label for="">Vui lòng nhập hình ảnh sản phẩm</label>
                            <input type="file" name="product_img" id="product_img" class="form-control img-file">
                            <div>
                                @if (!empty($product->getImage))
                                    <img src="{{ $product->getImage->url }}" class="img-preview" id="img_preview"
                                        alt="" width="200">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-preview"
                                        id="img_preview" width="200">
                                @endif
                            </div>
                        </div>
                        @if (!empty($product->id))
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-end">
                                    <div class="w-75">
                                        <label for="option_category">Thiết lập bổ sung</label>
                                        <select name="option_category" id="option_category" class="form-control">
                                            <option value="">Vui lòng chọn một tùy chỉnh bổ sung</option>
                                            @foreach ($optionCategories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#optionModal"
                                            id="btn_setup" class="btn btn-dark"
                                            onclick="getOptionContent({{ $product->id }})">Thiết lập
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="text-center py-3">
                        <button type="submit" class="btn btn-success" id="btn_submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (!empty($product->id))
        {{-- modal --}}
        <div class="modal fade" id="optionModal" tabindex="-1" aria-labelledby="optionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optionModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="option_form">
                            <table class="table table-bordered" id="option_table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Loại</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn_save_option"
                            onclick="saveOption({{ $product->id }})" data-bs-dismiss="modal">
                            Lưu thay đổi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endsection
