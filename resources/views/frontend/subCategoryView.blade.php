@extends('layouts.front')
@section('content')
    <div class="breadcrumb-area" style="background-image: url('{{ asset('fronted/img/banner/b1.jpg') }}')">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">SUB CATEGORY</h1>
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
            </div>


            <div class="col-md-9">
                <div class="row gy-5 justify-content-center">
                    @foreach ($Subcategory as $item)
                        <div class="col-lg-3 col-md-6 mb-4"> <!-- Added mb-4 for margin bottom -->
                            <a href="{{ url('view-products/' . $item->id) }}" class="text-decoration-none">

                                <div class="single-product-item">
                                    <div class="single-product-image">
                                        <img class="image-item-01" src="{{ asset('images/subcategories/' . $item->image) }}"
                                            alt="{{ $item->name }}"> <!-- Added alt attribute for accessibility -->
                                    </div>
                                    <div class="single-cart-content">
                                        <div class="cart-content-left">
                                            <h5>{{ $item->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="col-12 text-center">
                        <nav class="td-page-navigation" aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fa fa-angle-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


        </div>











    </div>
    </div>
@endsection
