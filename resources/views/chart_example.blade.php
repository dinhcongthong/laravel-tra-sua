@extends('layouts.admin')

@section('content')
<div class="page-title">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Welcome to dashboard admin</p>
</div>
<section class="section">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class='card-heading p-1 pl-3'>Sales</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="pl-3">
                                <h1 class='mt-5'>$21,102</h1>
                                <p class='text-xs'><span class="text-green"><i data-feather="bar-chart"
                                            width="15"></i> +19%</span> than last month</p>
                                <div class="legends">
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-info me-2'></div><span
                                            class='text-xs'>Last Month</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-blue me-2'></div><span
                                            class='text-xs'>Current Month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header">
                    <h4>Your Earnings</h4>
                </div>
                <div class="card-body">
                    <div id="radialBars"></div>
                    <div class="text-center mb-5">
                        <h6>From last month</h6>
                        <h1 class='text-green'>+$2,134</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
