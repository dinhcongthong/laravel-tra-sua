@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="card container">
            <div class="card-header">
                <h2 class="text-dark text-center">Cập nhật phương thức thanh toán</h2>
            </div>
            <div class="card-body">
                @include('layouts.notifications.admin_message')
                <form action="{{ route('admin.settings.payment.post_update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id ?? '' }}">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Nhập tên phương thức thanh toán</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $paymentMethod->name ?? old('name') }}">
                        </div>
                        <div class="col-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @foreach ($statuses as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ $key == optional($paymentMethod)->status ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-6">
                            <label for="payment_img">Vui lòng nhập hình ảnh</label>
                            <input type="file" name="payment_img" id="payment_img" class="form-control img-file">
                            <div class="col-12 py-3">
                                @if (!empty($paymentMethod->getImage))
                                    <img src="{{ $paymentMethod->getImage->url }}" class="img-preview" id="img_preview"
                                        alt="" width="200">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-preview"
                                        id="img_preview" width="200">
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" class="form-control">{{ $paymentMethod->note ?? old('note') }}</textarea>
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
