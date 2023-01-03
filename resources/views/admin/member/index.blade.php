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
        <h3>Member</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="py-3 d-flex justify-content-end">
                        <input type="text" name="search" value="{{ Request()->search }}"
                            class="form-control w-25" placeholder="Tìm kiếm tên sản phẩm">
                    </div>
                </form>
                <table class='table' id="crawler_table">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
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
