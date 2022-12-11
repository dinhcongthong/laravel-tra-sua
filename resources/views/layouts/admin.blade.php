<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/library/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/library/perfect-scroll-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/library/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    {{-- <link rel="stylesheet" href="{{ asset('css/library/chart.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/library/apexchart.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @yield('stylesheet')
</head>

<body>
<div class="main-loader">
    <div class="lds-spinner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:3rem;">
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Menu chính</li>
                        <li class="sidebar-item {{ Request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Thống kê</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="submenu p-0 {{ Request()->segment(2) == 'products' ? 'active' : '' }}">
                                {{-- sub-active class if exist --}}
                                <li class="{{ Request()->segment(2) == 'products' && Request()->segment(3) != 'options' ? 'sub-active' : '' }}">
                                    <a href="{{ route('admin.products.index') }}" class="">Sản phẩm</a>
                                </li>
                                <li class="{{ Request()->segment(3) == 'options' ? 'sub-active' : '' }}">
                                    <a href="{{ route('admin.products.options.index') }}" class="">Thiết lập bổ sung</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item {{ Request()->segment(2) == 'stores' ? 'active' : '' }}">
                            <a href="{{ route('admin.stores.index') }}" class='sidebar-link'>
                                <i data-feather="shopping-bag" width="20"></i>
                                <span>Cửa hàng</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request()->segment(2) == 'orders' ? 'active' : '' }}">
                            <a href="{{ route('admin.orders.index') }}" class='sidebar-link'>
                                <i data-feather="shopping-cart" width="20"></i>
                                <span>Đơn hàng</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="settings" width="20"></i>
                                <span>Cài đặt</span>
                            </a>
                            <ul class="submenu p-0 {{ Request()->segment(2) == 'settings' ? 'active' : '' }}">
                                {{-- sub-active class if exist --}}
                                <li class="{{ Request()->segment(3) == 'payment-method' ? 'sub-active' : '' }}">
                                    <a href="{{ route('admin.settings.payment.index') }}" class="">Cài đặt phương thức thanh toán</a>
                                </li>
                                <li class="{{ Request()->segment(3) == 'system' ? 'sub-active' : '' }}">
                                    <a href="{{ route('admin.settings.system.index') }}" class="">Cài đặt hệ thống</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="{{ asset('images/avatar-s-1.png')}}" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Thống</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    {{-- <div class="float-start">
                        <p>2022 &copy; Bản quyền</p>
                    </div>
                    <div class="float-end">
                        <p>thuộc về <span class='text-danger'><i data-feather="heart"></i></span>
                            <a href="https://fb.com/dinhcongthong">Đinh Công Thống</a></p>
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/library/perfect-scroll-bar.js') }}"></script>
    <script src="{{ asset('js/library/feather.min.js') }}"></script>
    <script src="{{ asset('js/library/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/library/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>

    {{-- vendors --}}
</body>

</html>
<script>
    var baseUrl = "{{ config('app.url') . '/admin' }}";
    var rootLoader = $('.main-loader');
</script>

@yield('scripts')
