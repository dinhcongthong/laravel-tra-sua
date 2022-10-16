@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <h3>Add new store</h3>
        <p class="text-subtitle text-muted">Let's add new your store here.</p>
    </div>
    <section class="section">
        <form action="{{ route('admin.stores.update') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="text" name="name" class="form-control" value="{{ $store->name ?? old('name') }}">
            </div>
            <div class="row">
                <input type="text" name="address" class="form-control" value="{{ $store->address ?? old('address') }}">
            </div>
            <div class="row">
                <input type="text" name="note" class="form-control" value="{{ $store->note ?? old('note') }}">
            </div>
            <div class="row">
                <select name="store_status_id" id="">
                    @foreach ($storeStatus as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <input type="file" name="store_img" class="form-control">
            </div>
        </form>
    </section>
@endsection
