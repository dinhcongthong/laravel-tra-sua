@extends('layouts.admin')
@section('stylesheet')
    <style>
        .category-items {
            border-bottom: 2px solid #0000000d;
            padding-bottom: 1.5rem;
        }

        .category-items:hover {
            --bs-table-accent-bg: var(--bs-table-striped-bg);
            color: #727e8c;
            transform: scale(1.01);
            transition: 0.2s;
        }

        .option-items-bg div.d-block:nth-child(odd) {
            border: 0;
            background-color: #edededa6;
        }
    </style>
@endsection

@section('content')
    <div class="w-75 m-auto">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="d-block">
                        <a href="#" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#categoryNewModal">
                            <i data-feather="plus-square" title="Them moi"></i> Thêm mới
                        </a>
                    </div>
                    @foreach ($optionCategory as $optionCategory)
                        <div class="d-block my-4 category-items">
                            <div class="d-flex category{{ $optionCategory->id }}">
                                <a class="" data-bs-toggle="collapse" role="button"
                                    href="#category{{ $optionCategory->id }}" aria-expanded="false"
                                    aria-controls="category{{ $optionCategory->id }}">
                                    {{ $optionCategory->name }}
                                </a>
                                <div class="ml-auto">
                                    <a href="#" class="category-edit" data-id="{{ $optionCategory->id }}"
                                        data-name="{{ $optionCategory->name }}"
                                        data-url="{{ route('admin.products.options.post_option_category', $optionCategory->id) }}">
                                        <i data-feather="edit" title="Edit"></i>
                                    </a>
                                    <a href="#" class="text-danger"
                                        onclick="deleteOptionCategory(`{{ route('admin.products.options.category_delete', $optionCategory->id) }}`, event)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                    <a href="#" class="text-success create-new-option"
                                        data-title="{{ $optionCategory->name }}" data-id="{{ $optionCategory->id }}"
                                        data-url="{{ route('admin.products.options.post_new_option') }}"
                                        data-bs-target="#optionNewModal" data-bs-toggle="modal">
                                        <i data-feather="plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="category{{ $optionCategory->id }}" class="collapse" aria-labelledby="headingOne">
                                <div class="p-3 option-items-bg">
                                    @foreach ($optionCategory->getOptions as $item)
                                        <div class="d-block px-2 py-3 option-items">
                                            <div class="d-flex option{{ $item->id }}">
                                                <p>{{ $item->name }}</p>
                                                <div class="ml-auto">
                                                    <a href="#" class="option-edit" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->name }}"
                                                        data-url="{{ route('admin.products.options.post_option', $item->id) }}">
                                                        <i data-feather="edit" title="Edit"></i>
                                                    </a>
                                                    <a href="#" class="text-danger"
                                                        onclick="deleteOption(`{{ route('admin.products.options.delete', $item->id) }}`, event)">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    {{-- new Category modal --}}
    <div class="modal fade" id="categoryNewModal" tabindex="-1" aria-labelledby="categoryNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryNewLabel">Thêm một danh mục mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="create_option_category">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveNewOptionCategory()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    {{-- new option modal --}}
    <div class="modal fade" id="optionNewModal" tabindex="-1" aria-labelledby="optionNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionNewLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="create_option">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_save_new_option">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/admin/option.js') }}"></script>
@endsection
