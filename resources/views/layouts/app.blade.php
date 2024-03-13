<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Le Thang PC - May tinh - Laptop - Camera - Thiet bi mang - Linh kiện điện tử</title>
    <link media="all" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/bootstrap.min.css') }}">
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" id="google-fonts-1-css"
        href="https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=auto&amp;ver=6.4.3"
        type="text/css" media="all">
    {{-- jquery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
</head>

<body
    class="page-template-default page page-id-4452 wp-embed-responsive theme-motta woocommerce-no-js product-card-layout-3 wcfm-theme-motta no-sidebar motta-shape--circle  site-content-no-top-spacing  site-content-no-bottom-spacing motta-navigation-bar-show elementor-default elementor-kit-4 elementor-page elementor-page-4452 currency-usd">
    <div id="page" class="site">
        <div id="site-header-minimized"></div>

        {{-- Header --}}
        @include('layouts.includes.header')

        <div id="site-content" class="site-content">
            @yield('content')
        </div>

        <!-- Navbar -->
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-transparent mb-4">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dịch vụ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> --}}

        {{-- Footer --}}
        @include('layouts.includes.footer')
    </div>

    {{-- Script lib --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery/jquery.js') }}" id="jquery-core-js"></script>
    <script type="text/javascript" src="{{ asset('js/regenerator-runtime.min6c85.js?ver=0.14.0') }}"
        id="regenerator-runtime-js"></script>
    <script defer src="{{ asset('js/autoptimize_18fe958446eb064cc8ce87e243c9428e.js') }}"></script>
</body>

@yield('scripts')

</html>
