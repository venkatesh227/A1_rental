@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/test1.jpeg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">PRODUCTS</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>Products</li>
                                {{-- @if (!empty($Product))
                                    <li>{{ strtoupper($Product[0]->Subcategory->name) }}</li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row gy-5 justify-content-center text-center">
                        @if (!empty($Product))
                            @foreach ($Product as $prod)
                                @php
                                    $product_id = $prod->id;
                                    $option_name = \App\Models\ProductImages::Where('product_id', $product_id)->first();
                                @endphp

                                <div class="col-lg-3 col-md-6 product_data">
                                    <a href="{{ url('product-details/' . $prod->subcategory_id . '/' . $prod->id) }}">
                                        <div class="single-product-item">
                                            <div class="single-product-image">
                                                <td>
                                                    @if (!empty($prod->image))
                                                        <img class="image-item-01"
                                                            src="{{ asset('images/products/' . $prod->image) }}"
                                                            alt="Product Image" width="100" height="200">
                                                    @endif
                                                </td>

                                            </div>
                                            <div class="single-cart-content">
                                                <div class="cart-content-left">
                                                    <h5>{{ mb_strimwidth($prod->name, 0, 30, '...') }}</h5>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <div class="">

                                                    <div class="flex-grow-1">
                                                        <del>{{ '$' . $prod->original_price }}</del>
                                                        <span
                                                            style="margin-left: 15px;font-weight:700;color:#c00;">{{ '$' . $prod->selling_price }}</span>
                                                    </div>


                                                </div>
                                            </div>


                                    </a>
                                    <input type="hidden" name="" value="{{ $prod->id }}" class="prod_id">

                                    @if ($prod->qty > 0)
                                        {{-- <div class="quantity buttons_added mb-2">

                                            <input type="button" value="-" class="minus decrement-btn">
                                            <input type="number" step="1" min="1" max="{{ $prod->qty }}"
                                                name="quantity" class="input-qty" value="1" disabled>
                                            <input type="button" value="+" class="plus increment-btn ">
                                        </div> --}}

                                        <div class="single-cart-button">
                                            <button type="submit" class="btn btn-title btn-block addToCartBtn">Add to Cart
                                                <i class="fa fa-shopping-basket ms-2"></i></button>
                                        </div>
                                    @else
                                        <div class="single-cart-button">
                                            <button type="button" class="btn btn-title addToCartBtn" disabled>Out of
                                                Stock</button>
                                        </div>
                                    @endif

                                </div>
                    </div>
                    @endforeach
                @else
                    <!-- Check if there is an error message -->

                    <div class="alert alert-danger text-center">No Products found. </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
    </div>
@endsection
