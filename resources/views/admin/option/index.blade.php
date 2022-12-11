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
@endsection
@section('scripts')
    <script src="{{ asset('js/admin/option.js') }}"></script>
@endsection
