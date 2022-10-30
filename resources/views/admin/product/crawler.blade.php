@extends('layouts.admin')

@section('stylesheet')
    <style>
        .paginator {
            padding-top: 1rem;
            display: flex;
            justify-content: center
        }
    </style>
@endsection

@section('content')
    <div class="page-title">
        <h3>Product Crawler</h3>
        <p class="text-subtitle text-muted">Get data from other websites</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.post_crawler') }}" method="post">
                    @csrf
                    <input type="hidden" name="store_id" value="{{ Request()->segment(4) }}">
                    <div class="py-3 d-flex justify-content-center">
                        <input type="text" name="crawl_url" value="{{ $store->crawl_url ?? '' }}"
                            class="form-control w-50" placeholder="Nhập URL cửa hàng bạn muốn lấy dữ liệu">
                        <button type="submit" class="btn btn-primary mx-3">Cập nhật</button>
                    </div>
                </form>
                <table class='table table-striped' id="crawler_table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Image</th>
                            <th>Crawl ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($products))
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <img src="{{ $product->getImage->url }}" width="80" alt="">
                                    </td>
                                    <td>{{ $product->crawl_id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ number_format($product->price) . ' đ' }}</td>
                                    <td>
                                        <span class="badge {{ $product->getStatus->color_class }}">
                                            {{ $product->getStatus->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.get_update_from_store', [$store->id, $product->id]) }}">
                                            <i data-feather="edit" title="Edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="paginator">
                    @if ($products->count() > 0)
                        {{ $products->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
