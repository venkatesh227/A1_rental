<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>A1 Rental</title>
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="{{ asset('fronted/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('fronted/css/style.css') }}">

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
    @include('frontend.inc.navbar')
    <!-- navbar end -->

    <!-- Banner Starts -->
    <section class="banner-area-2">
        <div class="container">
            <div class="banner-slider-2 owl-carousel">
                <div class="single-slide">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner-left">
                                <div class="banner-image">
                                    <img src="{{ asset('fronted/img/home-2/banner/slide-2.jpg') }}" alt="img">
                                    <span>01</span>
                                </div>
                                <div class="banner-icon">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 align-self-center">
                            <div class="banner-right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-content align-self-end">
                                            <h2>Welcome to <br>K&S Events and Rentals</h2>
                                            <p align="justify">Browse our rentals and create your Wishlist online by
                                                adding items with just a click. We’ll send you a preliminary quote so
                                                you can start designing your event.</p>
                                            <p align="justify">We have everything you need to make your corporate or
                                                private event spectacular. We offer everything from the necessities such
                                                as tables and chairs to décor such as backdrops and lounge furniture to
                                                enhance any style. </p>
                                        </div>
                                        <div class="banner-btn">
                                            <a href="#" class="btn btn-base">Search Products</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-img">
                                            <img class="mb-5"
                                                src="{{ asset('fronted/img/home-2/banner/slide-1.2.png') }}"
                                                alt="">
                                            <img src="{{ asset('fronted/img/home-2/banner/slide-1.3.png') }}"
                                                alt="">
                                            <span class="shadow-text">S</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-slide">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner-left">
                                <div class="banner-image">
                                    <img src="{{ asset('fronted/img/home-2/banner/slide-3.jpg') }}"alt="img">
                                    <span>02</span>
                                </div>
                                <div class="banner-icon">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 align-self-center">
                            <div class="banner-right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-content align-self-end">
                                            <h2>Welcome to <br>K&S Events and Rentals</h2>
                                            <p align="justify">Browse our rentals and create your Wishlist online by
                                                adding items with just a click. We’ll send you a preliminary quote so
                                                you can start designing your event.</p>
                                            <p align="justify">We have everything you need to make your corporate or
                                                private event spectacular. We offer everything from the necessities such
                                                as tables and chairs to décor such as backdrops and lounge furniture to
                                                enhance any style. </p>
                                        </div>
                                        <div class="banner-btn">
                                            <a href="#" class="btn btn-base">Search Products</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-img">

                                            <img class="mb-5"
                                                src="{{ asset('fronted/img/home-2/banner/slide-1.4.png') }}"alt="">
                                            <img src="{{ asset('fronted/img/home-2/banner/slide-1.5.png') }}"alt="">
                                            <span class="shadow-text">S</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-slide">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner-left">
                                <div class="banner-image">
                                    <img src="{{ asset('fronted/img/home-2/banner/slide-4.jpg') }}"alt="img">
                                    <span>03</span>
                                </div>
                                <div class="banner-icon">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 align-self-center">
                            <div class="banner-right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-content align-self-end">
                                            <h2>Welcome to <br>K&S Events and Rentals</h2>
                                            <p align="justify">Browse our rentals and create your Wishlist online by
                                                adding items with just a click. We’ll send you a preliminary quote so
                                                you can start designing your event.</p>
                                            <p align="justify">We have everything you need to make your corporate or
                                                private event spectacular. We offer everything from the necessities such
                                                as tables and chairs to décor such as backdrops and lounge furniture to
                                                enhance any style. </p>
                                        </div>
                                        <div class="banner-btn">
                                            <a href="#" class="btn btn-base">Search Products</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-img">

                                            <img class="mb-5"
                                                src="{{ asset('fronted/img/home-2/banner/slide-1.6.png') }}"alt="">
                                            <img src="{{ asset('fronted/img/home-2/banner/slide-1.7.png') }}"
                                                alt="">

                                            <span class="shadow-text">S</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-slide">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner-left">
                                <div class="banner-image">

                                    <img src="{{ asset('fronted/img/home-2/banner/slide-5.jpg') }}" alt="img">
                                    <span>04</span>
                                </div>
                                <div class="banner-icon">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 align-self-center">
                            <div class="banner-right">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-content align-self-end">
                                            <h2>Welcome to <br>K&S Events and Rentals</h2>
                                            <p align="justify">Browse our rentals and create your Wishlist online by
                                                adding items with just a click. We’ll send you a preliminary quote so
                                                you can start designing your event.</p>
                                            <p align="justify">We have everything you need to make your corporate or
                                                private event spectacular. We offer everything from the necessities such
                                                as tables and chairs to décor such as backdrops and lounge furniture to
                                                enhance any style. </p>
                                        </div>
                                        <div class="banner-btn">

                                            <a href="#" class="btn btn-base">Search Products</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="right-img">
                                            <img class="mb-5"
                                                src="{{ asset('fronted/img/home-2/banner/slide-1.8.png') }}"
                                                alt="">
                                            <img src="{{ asset('fronted/img/home-2/banner/slide-1.4.png') }}"
                                                alt="">
                                            <span class="shadow-text">S</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- about area start -->
    <div class="about-area bg-relative pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="about-area-inner">
                <div class="row">
                    <div class="col-lg-5 col-md-9 order-lg-2">
                        <div class="about-thumb-wrap about-left-thumb">

                            <img src="{{ asset('fronted/img/1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 align-self-center order-lg-1">
                        <div class="about-inner-wrap">
                            <div class="section-title mb-0">
                                <h2 class="title">OUR RENTALS</h2>
                                <p class="content">K&S Events and Rentals is a full-service Event Décor Company,
                                    encompassing event rentals, décor, design and planning. We have everything you need
                                    to make your corporate or private event spectacular; from tables and chairs to
                                    arches and backdrops, from wedding Structures such as Mandaps and Chuppahs to
                                    ceiling structures with greens and chandeliers, we want to make your event unique!
                                </p>
                                <a href="#" class="btn btn-title">Explore Collection <span>&rharu;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->

    <!-- Categories Starts -->
    <section class="categories-area pd-bottom-120">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2 class="title">Categories</h2>
                    </div>
                    <div class="category-slider owl-carousel">
                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-1.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Tables</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-2.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Chairs</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-3.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Tents</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-4.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Liners</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">
                                    <img src="{{ asset('fronted/img/category/cat-5.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Flooring</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-6.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Carpets</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-7.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Centerpiece</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">
                                    <img src="{{ asset('fronted/img/category/cat-8.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Lighting</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single-cat-item">
                                <div class="thumb">

                                    <img src="{{ asset('fronted/img/category/cat-9.png') }}" alt="img">
                                </div>
                                <div class="single-cat-content">
                                    <h4><a href="#">Others</a></h4>
                                    <a class="read-more-text" href="#">Explore Collection </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories End -->


    <!-- Video Starts -->
    <section class="video-area " style="background: #ffdec6;">
        <div class="bg-half-white"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="video-thumb">

                        <img src="{{ asset('fronted/img/bg/video-bg.png') }}" alt="img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="video-content">
                        <div class="section-title pt-5">
                            <h2 class="title mb-3">Why K&S for Event Rentals?</h2>
                            <h4>More ways to be served</h4>
                            <p class="content">
                            <ul>
                                <li>Quality rental items delivered by friendly professionals</li>
                                <li>Prior day delivery for peace of mind.</li>
                                <li>Competitive nominal delivery fees</li>
                                <li>Experienced event consultants to guide you through every step</li>
                            </ul>
                            </p>
                        </div>

                        <a href="#" class="btn btn-title">Read More... <span>&#8640;</span></a>
                        <div class="video-icon">
                            <a class="video-play-btn" href="#" data-effect="mfp-zoom-in"><i
                                    class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video End -->

    <!-- testimonial area start -->
    <div class="testimonial-area pd-top-115">
        <div class="bg-half-main"></div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-6 col-md-11">
                    <div class="section-title">
                        <h2 class="title">Client
                            Testimonials</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="testimonial-slider slider-control-dots owl-carousel">
                        <div class="single-slide">
                            <div class="slide-top d-flex">
                                <div class="slide-image">

                                    <img src="{{ asset('fronted/img/testimonial/slide-1.png') }}" alt="">
                                </div>
                                <div class="slide-content align-self-center">
                                    <h4>Annaa Edouard</h4>
                                    <h6 class="diff-h6">Fashion Stylist</h6>
                                </div>
                            </div>
                            <div class="slide-bottom">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus augue nibh, at
                                    ullamcorper orci ullamcorper ut. Nisl tincidunt eget nullam non nisi est. Pharetra
                                    et ultrices neque ornare.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                    rhoncus augue nibh, at ullamcorper orci ullamcorper ut.</p>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="slide-top d-flex">
                                <div class="slide-image">

                                    <img src="{{ asset('fronted/img/testimonial/slide-2.png') }}" alt="">
                                </div>
                                <div class="slide-content align-self-center">
                                    <h4>Annaa Edouard</h4>
                                    <h6 class="diff-h6">Fashion Stylist</h6>
                                </div>
                            </div>
                            <div class="slide-bottom">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus augue nibh, at
                                    ullamcorper orci ullamcorper ut. Nisl tincidunt eget nullam non nisi est. Pharetra
                                    et ultrices neque ornare.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                    rhoncus augue nibh, at ullamcorper orci ullamcorper ut.</p>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="slide-top d-flex">
                                <div class="slide-image">


                                    <img src="{{ asset('fronted/img/testimonial/slide-1.png') }}" alt="">
                                </div>
                                <div class="slide-content align-self-center">
                                    <h4>Annaa Edouard</h4>
                                    <h6 class="diff-h6">Fashion Stylist</h6>
                                </div>
                            </div>
                            <div class="slide-bottom">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus augue nibh, at
                                    ullamcorper orci ullamcorper ut. Nisl tincidunt eget nullam non nisi est. Pharetra
                                    et ultrices neque ornare.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                    rhoncus augue nibh, at ullamcorper orci ullamcorper ut.</p>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="slide-top d-flex">
                                <div class="slide-image">
                                    <img src="{{ asset('fronted/img/testimonial/slide-2.png') }}" alt="">
                                </div>
                                <div class="slide-content align-self-center">
                                    <h4>Annaa Edouard</h4>
                                    <h6 class="diff-h6">Fashion Stylist</h6>
                                </div>
                            </div>
                            <div class="slide-bottom">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus augue nibh, at
                                    ullamcorper orci ullamcorper ut. Nisl tincidunt eget nullam non nisi est. Pharetra
                                    et ultrices neque ornare.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                    rhoncus augue nibh, at ullamcorper orci ullamcorper ut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial area end -->


    <!-- Footer Starts -->
    @include('frontend.inc.footer')
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
