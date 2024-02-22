<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Le Thang PC - May tinh - laptop - camera - thiet bi mang</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/bootstrap.min.css') }}">
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    {{-- jquery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
</head>

<body>
   
    <!-- Header -->
    <header>
        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <a href='{{route('home')}}'><h1>Logo</h1></a>
                </div>
                <div class="col-md-4 d-flex mt-2">
                    <div class="mb-2 me-2 mb-0">
                        <a href="#" class="btn btn-secondary" id='cart-icon' >
                            <i class="fas fa-shopping-cart"></i>  Giỏ hàng
                        </a>
                    </div>
                    <div class="mb-2 me-2 mb-0">
                        <a href="#" class="btn btn-secondary">Đăng nhập</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-secondary">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
{{-- Section slider lon --}}
{{-- Section san pham --}}
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent mb-4">
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
    </nav>
    
    <div class="">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="p-4">
            <div class="row">
                <div class="col-md-3">
                    <h6>Hỗ Trợ - Dịch Vụ</h6>
                    <ul class="list-unstyled">
                        <li>Chính sách và hướng dẫn mua hàng trả góp</li>
                        <li>Hướng dẫn mua hàng và chính sách vận chuyển</li>
                        <li>Tra cứu đơn hàng</li>
                        <li>Chính sách đổi mới và bảo hành</li>
                        <li>Dịch vụ bảo hành mở rộng</li>
                        <li>Chính sách bảo mật</li>
                        <li>Chính sách giải quyết khiếu nại</li>
                        <li>Quy chế hoạt động</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Thông Tin Liên Hệ</h6>
                    <ul class="list-unstyled">
                        <li>Thông tin các trang TMĐT</li>
                        <li>Dịch vụ sửa chữa Hoàng Hà Care</li>
                        <li>Khách hàng doanh nghiệp (B2B)</li>
                        <li>Tra cứu bảo hành</li>
                        <li>Hệ thống 128 siêu thị trên toàn quốc</li>
                        <li>Danh sách 128 siêu thị trên toàn quốc</li>
                        <li>Tổng đài: 1900.2091</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Hình thức vận chuyển</h6>
                    <!-- Thêm thông tin vận chuyển tại đây -->
                </div>
                <div class="col-md-3">
                    <h6>© 2020. CÔNG TY CỔ PHẦN XÂY DỰNG VÀ ĐẦU TƯ THƯƠNG MẠI HOÀNG HÀ. MST: 0106713191.</h6>
                    <p>(Đăng ký lần đầu: Ngày 15 tháng 12 năm 2014, Đăng ký thay đổi ngày 24/11/2022)</p>
                    <p>GP số 426/GP-TTĐT do sở TTTT Hà Nội cấp ngày 22/01/2021</p>
                    <p>Địa chỉ: Số 89 Đường Tam Trinh, Phường Mai Động, Quận Hoàng Mai, Thành Phố Hà Nội, Việt Nam.</p>
                    <p>Điện thoại: 1900.2091. Chịu trách nhiệm nội dung: Hoàng Ngọc Chiến.</p>
                </div>
            </div>
        </div>
    </footer>
    
    {{-- Script lib --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

@yield('scripts')

</html>
