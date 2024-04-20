@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/b1.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Products</h1>
                            <ul class="page-list">
                                <li><a href="#">HOME</a></li>
                                <li>PRODUCTS</li>
                                <li>TABLES</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="product-area">
        <div class="pt-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="vertical-menu">
                        <a href="#" class="active">Home</a>
                        <a href="#">About</a>
                        <a href="#">Services</a>
                        <a href="#">Contact</a>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="row gy-5 justify-content-center">
                        @foreach ($Product as $prod)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ url('product-details/'.$prod->subcategory_id . '/' . $prod->id) }}" class="text-decoration-none">

                                    <div class="single-product-item">
                                        <div class="single-product-image">
                                            <img class="image-item-01" src="{{ asset('images/products/' . $prod->image) }}"
                                                alt="img">
                                        </div>

                                        <div class="single-cart-content">
                                            <div class="cart-content-left">
                                                <h5>{{ $prod->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="single-cart-button">
                                            <a href="#" class="btn btn-title">Add to Wishlist</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>











        </div>
    </div>
@endsection
