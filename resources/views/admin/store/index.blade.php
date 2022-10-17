@extends('layouts.admin')

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
                Store list
            </div>
            <div class="card-body">
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
                                    <span
                                        class="badge {{ $item->getStatus->color_class }}">{{ $item->getStatus->name }}</span>
                                </td>
                                <td>
                                    <img src="{{ $item->getImage->url }}" width="80" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('admin.stores.get_update', $item->id) }}"
                                        class="btn btn-default text-dark mx-2">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.stores.delete', $item->id) }}"
                                        class="btn btn-danger text-dark mx-2 store-delete" data-bs-toggle="modal"
                                        data-bs-target="#del_modal">
                                        Delete
                                    </a>
                                    <a href="{{ route('admin.products.create', $item->id) }}"
                                        class="btn btn-primary text-dark">
                                        Add product
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!--Basic Modal -->
    <div class="modal fade text-left" id="del_modal" tabindex="-1" role="dialog" aria-labelledby="mydel_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mydel_modal">Ban co thuc su muon xoa cua hang nay khong?</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Xoa cua hang nay dong nghia voi viec tat ca san pham trong cua hang nay khong hoat dong nua.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-danger ml-1" id="btn_confirm" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
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
