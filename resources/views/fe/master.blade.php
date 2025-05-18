<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>pillloMart</title>
    <link rel="icon" href="{{asset('fe/img/favicon.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/owl.carousel.min.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/all.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('fe/css/themify-icons.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('fe/css/style.css')}}">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('home') }}"> <img src="{{asset('be/img/cloupillsblue2.png')}}" alt="logo" style="width: 200px; height: auto;"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('fe.about.index') }}">about</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        product
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="{{ route('list.index') }}"> product list</a>
                                        <a class="dropdown-item" href="">product details</a>

                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex align-items-center">
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <a href="{{ route('cart.index') }}">
                                <i class="flaticon-shopping-cart-black-shape"></i>
                            </a>
                        </div>
                          <!-- Profile -->
                        <!-- Profile Section -->
                        <div class="dropdown" style="display: flex; align-items: center;">
                            @if(Auth::guard('pelanggan')->check())
                                @php
                                    $pelanggan = Auth::guard('pelanggan')->user();
                                    $profileImage = $pelanggan->foto && $pelanggan->foto != 'default.jpg'
                                        ? asset('storage/'.$pelanggan->foto)
                                        : asset('images/default-user.jpg');
                                @endphp
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="display: flex; align-items: center;">
                                    <img src="{{ $profileImage }}"
                                        class="rounded-circle"
                                        style="width: 35px; height: 35px; object-fit: cover; margin-left: 50px;"
                                        alt="Profile Image">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 200px;">
                                    <li><a class="dropdown-item"><strong class="ml-2">{{ $pelanggan->nama_pelanggan }} - My Profile</strong></a></li>
                                    <li><a class="dropdown-item" href="{{ route('profilefe.index') }}"><i class="fa fa-id-card mr-2"></i> Your Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-bag mr-2"></i> Your Orders</a></li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout-pelanggan') }}" method="POST">
                                            @csrf
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="dropdown-item-icon ti-power-off"></i> Sign Out
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="display: flex; align-items: center;">
                                    <i class="fa fa-user-o" style="font-size: 20px; margin-right: 5px;"></i>
                                    <span style="margin-left: 8px;">Guest</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 200px;">
                                    <li><a class="dropdown-item"><strong class="ml-2">Guest</strong></a></li>
                                    <li><a class="dropdown-item" href="{{ route('loginfe') }}"><i class="fa fa-user me-2"></i> Login</a></li>
                                    <li><a class="dropdown-item" href="{{ route('registerfe') }}"><i class="fa fa-user-plus me-2"></i> Register</a></li>
                                </ul>
                            @endif
                        </div>
                        <!-- /Profile -->

                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    @yield('list')
    @yield('banner')
    @yield('produk-list')
    @yield('trending-item')
    @yield('about')
    @yield('single-produk')
    @yield('cart')
    @yield('contact')
    <!-- feature part here -->
    @yield('review')
    <!-- feature part end -->

    <!-- client review part here -->
    @yield('feature')
    <!-- client review part end -->

    <!-- subscribe part here -->
    @yield('subscribe')
    <!-- subscribe part end -->

    @yield('profilefe')

    <!--::footer_part start::-->
    <footer class="footer_part" style="position: static">
        <div class="footer_iner">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-8">
                        <div class="footer_menu">
                            <div class="footer_logo">
                                <a href="{{ route('home') }}"><img src="{{asset('fe/img/logo.png')}}" alt="#"></a>
                            </div>
                            <div class="footer_menu_item">
                                <a href="{{ route('home') }}">Home</a>
                                <a href="{{ route('fe.about.index') }}">About</a>
                                <a href="{{ route('list.index') }}">Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="social_icon">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright_part">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                            <div class="copyright_link">
                                <a href="#">Turms & Conditions</a>
                                <a href="#">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="{{asset('fe/js/jquery-1.12.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('fe/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('fe/js/bootstrap.min.js')}}"></script>
    <!-- magnific popup js -->
    <script src="{{asset('fe/js/jquery.magnific-popup.js')}}"></script>
    <!-- carousel js -->
    <script src="{{asset('fe/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('fe/js/jquery.nice-select.min.js')}}"></script>
    <!-- slick js -->
    <script src="{{asset('fe/js/slick.min.js')}}"></script>
    <script src="{{asset('fe/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('fe/js/waypoints.min.js')}}"></script>
    <script src="{{asset('fe/js/contact.js')}}"></script>
    <script src="{{asset('fe/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('fe/js/jquery.form.js')}}"></script>
    <script src="{{asset('fe/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('fe/js/mail-script.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('fe/js/custom.js')}}"></script>
</body>

</html>
