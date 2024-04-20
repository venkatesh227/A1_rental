<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A1 Rental</title>
    <link rel=icon href="{{ asset('fronted/img/favicon.png') }}" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('fronted/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('fronted/css/style.css') }}">
    <style>
        /* Custom styles for the vertical menu */
        .vertical-menu {
            width: 200px;
            /* Set a width for the menu */
        }

        .vertical-menu a {
            background-color: #f8f9fa;
            /* Grey background color */
            color: #343a40;
            /* Black text color */
            display: block;
            /* Make the links fill the entire width of the container */
            padding: 12px;
            /* Add some padding */
            text-decoration: none;
            /* Remove underline from links */
            border-bottom: 1px solid #dee2e6;
            /* Add a border between links */
        }

        .vertical-menu a:hover {
            background-color: #e9ecef;
            /* Dark grey background color on hover */
        }
    </style>
    </style>
</head>

<body>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- search popup start-->
    <div class="td-search-popup" id="td-search-popup">
        <form action="#" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- navbar start -->
    <div class="navbar-area">
        <nav class="navbar navbar-area-2 navbar-area navbar-expand-lg">
            <div class="container-fluid nav-container">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#st_main_menu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
                    <a href="home.html"><img src="{{ asset('fronted/img/logo1.png') }}" alt="img"></a>
                </div>
                <div class="nav-right-part nav-right-part-mobile">
                    <a class="search-bar-btn" href="#"><i class="lnr lnr-magnifier"></i></a>
                    <a class="user-btn" href="wishlist.html"><i class="lnr lnr-user"></i></a>
                    <a class="cart-btn" href="cart.html"><span class="cart-count">2</span><i
                            class="lnr lnr-cart"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="st_main_menu">
                    <ul class="navbar-nav menu-open">
                        <li class="menu-item-has-children current-item-has-children">
                            <a href="#">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Products</a>
                            <ul class="sub-menu">
                                <li><a href="#">Tables</a></li>
                                <li><a href="#">Chairs</a></li>
                                <li><a href="#">Liners</a></li>
                                <li><a href="#">Tents</a></li>
                                <li><a href="#">Flooring</a></li>
                                <li><a href="#">Carpet</a></li>
                                <li><a href="#">Centerpiece</a></li>
                                <li><a href="#">Lighting</a></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop">
                    <a class="search-bar-btn" href="#"><i class="lnr lnr-magnifier"></i></a>
                    <a class="user-btn" href="#"><i class="lnr lnr-user"></i></a>
                    <a class="cart-btn" href="#"><span class="cart-count">2</span><i class="lnr lnr-cart"></i></a>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('assets/img/banner/b1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Login or Register User</h1>
                            <ul class="page-list">
                                <li><a href="#">HOME</a></li>
                                <li>Login or Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <section class="checkout-area pt-5 pb-5" style="background-color: #F8F8F8;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="checkout-inner pd-bottom-50">
                        <h3 class="mb-3">Login</h3>
                        <form action="{{ url('user-login-check') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-bg">
                                            <input type="text" placeholder="User Name" name="phone">
                                        </div>
                                        <span class="text-danger mt-1">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-bg">
                                            <input type="text" placeholder="Password" name="password">
                                        </div>
                                        <span class="text-danger mt-1 ">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-title">
                                            Login
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="text-right pull-right" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <a href="register.html">Dont have an account? Register here</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area start -->



    <!-- Footer Starts -->
    <footer class="footer-area">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget widget widget_nav_menu">
                            <h5 class="widget-title">help & information</h5>
                            <ul>
                                <li><a href="#">help</a></li>
                                <li><a href="#">track order</a></li>
                                <li><a href="#">delivery & returns</a></li>
                                <li><a href="#">10% student discount</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget widget widget_nav_menu">
                            <h5 class="widget-title">about us</h5>
                            <ul>
                                <li><a href="#">about us</a></li>
                                <li><a href="#">career at theshop</a></li>
                                <li><a href="#">investors site</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget widget widget_nav_menu">
                            <h5 class="widget-title">Customer Care</h5>
                            <ul>
                                <li><a href="#">gift card</a></li>
                                <li><a href="#">size guide</a></li>
                                <li><a href="#">terms & condition</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget widget widget-newsletter">
                            <h5 class="widget-title">newsletter</h5>
                            <p>Sign up to Theshop newlettter for 10% <br>Discount code.</p>
                            <form action="#" class="mt-4">
                                <input type="email" class="" placeholder="Your Email Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'"
                                    required>
                                <button type="submit"> <span>&rharu;</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-lg-flex justify-content-between">
                        <div class="copyright-logo align-self-center">
                            <a href="#"><img src="assets/img/logo1.png" alt="img"></a>
                        </div>
                        <div class="copyright-content align-self-center text-center">
                            &copy; Copyright 2023 - All rights reserved.
                        </div>
                        <div class="copyright-link align-self-center">
                            <ul>
                                <li><a href="#">Instagram</a></li>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->


    <!-- all plugins here -->
    <script src="{{ asset('fronted/js/vendor.js') }}"></script>
    <!-- main js  -->
    <script src="{{ asset('fronted/js/main.js') }}"></script>
</body>

</html>
