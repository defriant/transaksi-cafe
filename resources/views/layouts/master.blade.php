<!doctype html>
<html lang="en">

<head>
    <title>Cafe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome-pro-master/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
    {{-- Datatime picker --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
    <!-- Env Color -->
    <link rel="stylesheet" href="{{ asset('assets/css/envColor.css') }}">
    <script src="{{ asset('assets/scripts/envColor.js') }}"></script>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/logo.png') }}">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    @if (Auth::user()->role == "admin")
        <style>
            .admin-hide {
                display: none;
            }
        </style>
    @elseif(Auth::user()->role == "kasir")
        <style>
            .kasir-hide {
                display: none;
            }
        </style>
    @endif
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="/dashboard"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('assets/img/admin.png') }}" class="img-circle" alt="Avatar"> <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        @if (Auth::user()->role == "admin")
                            <li>
                                <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="/admin/produk" class="{{ Request::is('admin/produk') ? 'active' : '' }}"><i class="fal fa-mug-hot"></i> <span>Produk</span></a>
                            </li>
                            <li>
                                <a href="/admin/history-transaksi" class="{{ Request::is('admin/history-transaksi') ? 'active' : '' }}"><i class="fal fa-sack-dollar"></i> <span>History Transaksi</span></a>
                            </li>
                        @elseif(Auth::user()->role == "kasir")
                            <li>
                                <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}"><i class="fal fa-mug-hot"></i> <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="/transaksi" class="{{ Request::is('transaksi') ? 'active' : '' }}"><i class="fal fa-cash-register"></i> <span>Transaksi</span></a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; {{ date('Y') }}. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/scripts/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
    <script src="{{ asset('assets/scripts/main.js') }}"></script>
    @if (Request::is('admin/dashboard'))
        <script src="{{ asset('assets/scripts/dashboard.js') }}"></script>
    @elseif (Request::is('admin/produk') || Request::is('dashboard'))
        <script src="{{ asset('assets/scripts/produk.js') }}"></script>
    @elseif (Request::is('admin/history-transaksi') || Request::is('transaksi'))
        <script src="{{ asset('assets/scripts/transaksi.js') }}"></script>
    @endif
    @yield('scripts')
</body>

</html>
