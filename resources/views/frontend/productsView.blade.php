@extends('layouts.front')
@section('content')
<!-- Banner Starts -->
<div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/b1.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <div class="section-title text-center mb-0">
                        <h1 class="page-title">PRODUCTS</h1>
                        <ul class="page-list">
                            <li><a href="{{ url('/') }}">HOME</a></li>
                            <li>CATEGORIES</li>
                            @if (!empty($Product))
                                <li>{{ strtoupper($Product[0]->Subcategory->name) }}</li>
                            @endif
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
                    <a href="{{url('/')}}" class="active">Home</a>
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="{{url('email')}}">Contact</a>
                </div>
            </div>


            <div class="col-md-9">
                <div class="row gy-5 justify-content-center">
                    @if (!empty($Product))
                                    @foreach ($Product as $prod)
                                                    @php
                                                        $product_id = $prod->id;
                                                        $option_name = \App\Models\Product_images::Where(
                                                            'product_id',
                                                            $product_id,
                                                        )->first();
                                                    @endphp

                                                    <div class="col-lg-3 col-md-6 product_data">
                                                        <a href="{{ url('product-details/' . $prod->subcategory_id . '/' . $prod->id) }}">
                                                            <div class="single-product-item">
                                                                <div class="single-product-image">
                                                                    <td>
                                                                        @if (!empty($option_name->image))
                                                                            <img class="image-item-01"
                                                                                src="{{ asset('images/products/' . $option_name->image) }}"
                                                                                alt="Product Image" width="100" height="200">
                                                                        @endif
                                                                    </td>

                                                                </div>
                                                                <div class="single-cart-content">
                                                                    <div class="cart-content-left">
                                                                        <h5>{{ $prod->name }}</h5>
                                                                    </div>
                                                                </div>
                                                        </a>

                                                        <div class="quantity buttons_added mb-2">
                                                            <input type="hidden" name="" value="{{ $prod->id }}" class="prod_id">
                                                            <input type="button" value="-" class="minus decrement-btn">
                                                            <input type="number" step="1" min="1" max="{{ $prod->qty }}" name="quantity"
                                                                class="input-qty" value="1">
                                                            <input type="button" value="+" class="plus increment-btn ">
                                                        </div>

                                                        <div class="single-cart-button">
                                                            <button type="submit" class="btn btn-title addToCartBtn">Add to Cart <i
                                                                    class="fa fa-shopping-basket ms-2"></i></button>
                                                        </div>

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