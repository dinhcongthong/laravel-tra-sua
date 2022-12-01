@extends('layouts.admin')

@section('content')
    <div class="w-50 m-auto">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class='table' id="option_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($optionCategory as $optionCategory)
                            <tr>
                                <td>
                                    <a class="" data-bs-toggle="collapse"
                                       role="button"
                                       href="#category{{ $optionCategory->id }}" aria-expanded="false"
                                       aria-controls="category{{ $optionCategory->id }}">
                                        {{ $optionCategory->name }}
                                    </a>
                                    <div id="category{{ $optionCategory->id }}" class="collapse"
                                         aria-labelledby="headingOne">
                                        <div class="pt-3">
                                            @foreach ($optionCategory->getOptions as $item)
                                                <p>{{ $item->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#">
                                        <i data-feather="edit" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
