@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <h3>Stores</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your store</p>
        <a href="{{ route('admin.stores.update') }}" class="btn btn-success mb-3 fw-bold">+ Add new</a>
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
                                <span class="badge {{ $item->getStatus->color_class }}">{{ $item->getStatus->name }}</span>
                            </td>
                            <td>
                                <img src="{{ $item->getImage->url }}" width="80" alt="">
                            </td>
                            <td>
                                <a href="{{ route('admin.products.update', $item->id) }}" class="btn btn-default">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
