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
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>PRODUCTS</li>
                                <li>{{ strtoupper($category_name->name) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="product-area">
        <div class="pt-5">
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
                            @if (!empty($Subcategory))
                                @foreach ($Subcategory as $item)
                                    @if (!empty($item->status))
                                        <div class="col-lg-3 col-md-6"> <!-- Added mb-4 for margin bottom -->
                                            <a href="{{ url('view-products/' . $item->id) }}" class="text-decoration-none">
                                                <div class="single-product-item">
                                                    <div class="single-product-image">
                                                        <img class="image-item-01"
                                                            src="{{ asset('images/subcategories/' . $item->image) }}"
                                                            alt="{{ $item->name }}">
                                                        <!-- Added alt attribute for accessibility -->
                                                    </div>
                                                    <div class="single-cart-content">
                                                        <div class="cart-content-left">
                                                            <h5>{{ $item->name }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif


                            <div class="row">
                                <div class="col-12 text-center">
                                    <ul class="pagination">
                                        @if (!empty($Subcategory[0]->status))


                                            @if (!empty($Subcategory))
                                                @if ($Subcategory->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $Subcategory->previousPageUrl() }}">&lt;</a></li>
                                                @endif

                                                @for ($i = 1; $i <= $Subcategory->lastPage(); $i++)
                                                    @if ($i == $Subcategory->currentPage())
                                                        <li class="page-item active"><span
                                                                class="page-link">{{ $i }}</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{ $Subcategory->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endif
                                                @endfor

                                                @if ($Subcategory->hasMorePages())
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $Subcategory->nextPageUrl() }}">&gt;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">&gt;</span></li>
                                                @endif
                                            @endif
                                        @else
                                            <!-- Check if there is an error message -->
                                            <div class="col-md-12">
                                                <div class="alert alert-danger text-center mt-5">
                                                    No subcategories found for this
                                                </div>
                                            </div>

                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
