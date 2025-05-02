@extends('layouts.front')
@section('content')
    <div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/test1.jpeg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">PRODUCT DETAILS</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>PRODUCTS DETAILS</li>
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
                <div class="col-md-12">
                    <div class="product-details-area ">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6">
                                <div class="product-thumbnail-wrapper">
                                    <div class="single-thumbnail-slider-2">
                                        <div class="slider-item">
                                            @if (!empty($Product->image))
                                                <img id="mainImage" src="{{ asset('images/products/' . $Product->image) }}"
                                                    alt="item" height="300px" width="300px">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="product-thumbnail-carousel-2">
                                    @if (!empty($Product->image))
                                        <div class="single-thumbnail-item">
                                            <img class="thumbnail" src="{{ asset('images/products/' . $Product->image) }}"
                                                alt="item" height="100px" width="100px">
                                        </div>
                                    @endif
                                    @foreach ($productImages as $image)
                                        <div class="single-thumbnail-item">
                                            <img class="thumbnail"
                                                src="{{ asset('images/product_images/' . $image->image) }}" alt="item"
                                                height="100px" width="100px">
                                        </div>
                                    @endforeach
                                </div> --}}
                                </div>

                            </div>
                            <div class="col-lg-7">
                                <div class="product-item-details product_data mt-3">
                                    <h4 class="entry-title">{{ $Product->name }}</h4>
                                    <p>{{ $Product->small_description }}</p>

                                    <div class="price">{{ '$' . $Product->selling_price }}
                                        <del>{{ '$' . $Product->original_price }}</del>
                                    </div>
                                    <form>
                                        <input type="hidden" name="" value="{{ $Product->id }}" class="prod_id">

                                        @if ($Product->qty > 0)
                                            {{-- <div class="quantity buttons_added">


                                            <input type="button" value="-" class="minus  decrement-btn">
                                            <input type="number" step="1" min="1" max="{{ $Product->qty }}" name="quantity"
                                                class="input-qty" value="1" disabled>
                                            <input type="button" value="+" class="plus increment-btn">

                                        </div> --}}
                                            <button type="submit" class="btn btn-title addToCartBtn">Add to Cart <i
                                                    class="fa fa-shopping-basket ms-2"></i></button>
                                        @else
                                            <button type="button" class="btn btn-title addToCartBtn" disabled>Out of
                                                Stock</button>
                                        @endif
                                        <?php $userLoggedIn = session()->has('userId'); ?>

                                        @if ($userLoggedIn)
                                            <button type="button" class="btn btn-border-black mt-4"><i
                                                    class="fa fa-phone"></i>Enquiry</button>
                                        @endif
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-details-tab-area pd-top-60">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-details-tabs">
                                    <ul class="nav nav-tabs product-tab" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">DESCRIPTION</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false" tabindex="-1">ADDITIONAL
                                                INFO</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false" tabindex="-1">Gallery</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="delivery-tab" data-bs-toggle="tab"
                                                data-bs-target="#delivery" type="button" role="tab"
                                                aria-controls="delivery" aria-selected="false" tabindex="-1">SHIPPING &
                                                DELIVERY</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content specific-tab" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">

                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <p>{{ $Product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade describe-tab" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <p>
                                            <p>{{ $Product->additional_info }}</p>
                                            </p>
                                        </div>


                                        <div class="tab-pane review-tab fade" id="review" role="tabpanel"
                                            aria-labelledby="review-tab">
                                            <div class="row">
                                                @foreach ($productImages as $image)
                                                    @php
                                                    @endphp
                                                    <div class="col-lg-4">
                                                        <img src="{{ asset('images/products/' . $image->image) }}"
                                                            class="img-fluid" />
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade delivery-tab" id="delivery" role="tabpanel"
                                            aria-labelledby="delivery-tab">
                                            <div class="row">
                                                <p>{{ $Product->shipping_delivery }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainImage = document.getElementById('mainImage');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const newSrc = this.getAttribute('src');
                    mainImage.setAttribute('src', newSrc);
                });
            });
        });
    </script>
@endsection
