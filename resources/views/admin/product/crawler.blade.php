@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <h3>Product Crawler</h3>
        <p class="text-subtitle text-muted">Get data from other websites</p>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
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
                        @foreach ($store->getProducts as $product)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>
                                    <img src="{{ $item->getImage->url }}" width="80" alt="">
                                </td>
                                <td>{{ $product->crawl_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <span class="badge {{ $product->getStatus->color_class }}">
                                        {{ $product->getStatus->name }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.get_update', $item->id) }}">
                                        <i data-feather="edit" title="Edit"></i>
                                    </a>
                                    <a href="{{ route('admin.products.delete', $item->id) }}" class="mx-2 product-delete"
                                        data-bs-toggle="modal" data-bs-target="#del_modal">
                                        <i class="text-danger" data-feather="trash-2" title="Delete"></i>
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
            $('.product-delete').on('click', function(e) {
                $('#del_modal').modal('show');
                let url = $(this).attr('href');
                $('#btn_confirm').on('click', function(e) {
                    // window.location.href = url;
                    const form = document.createElement('form');
                    form.method = 'DELETE';
                    form.action = "{{ route('admin.products.delete')}}";

                    const hiddenField = document.createElement('input');
                    for (const key in params) {
                        if (params.hasOwnProperty(key)) {
                            hiddenField.type = 'hidden';
                            hiddenField.name = key;
                            hiddenField.value = params[key];

                            form.appendChild(hiddenField);
                        }
                    }

                    document.body.appendChild(form);
                    form.submit();
                })
            })
        }
    </script>
@endsection
