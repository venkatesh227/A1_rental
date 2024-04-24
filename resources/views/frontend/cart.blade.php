@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('assets/img/banner/b1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Product Details</h1>
                            <ul class="page-list">
                                <li><a href="#">HOME</a></li>
                                <li>PRODUCTS</li>
                                <li>Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="cart-area  mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 product_data">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th class="text-start" scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cartitems as $item)
                                    <tr class="product_data">
                                        <th scope="row">
                                            @if (isset($productImages[$item->id]))
                                                <img src="{{ asset('images/products/' . $productImages[$item->id]->image) }}"
                                                    alt="img">
                                            @endif
                                        </th>
                                        <td class="item-name"><a href="#">{{ $item->products->name }}</a></td>
                                        <td class="price">{{ $item->products->price }}</td>
                                        <td class="table-quantity">
                                            <form>
                                                <div class="quantity buttons_added">
                                                    <input type="hidden" name="" value="{{ $item->prod_id }}"
                                                        class="prod_id">
                                                    <input type="button" value="-"
                                                        class="minus decrement-btn changeqty">
                                                    <input type="number" step="1" min="1" max="10000"
                                                        name="quantity" class="input-qty" value="{{ $item->prod_qty }}">
                                                    <input type="button" value="+"
                                                        class="plus increment-btn changeqty">
                                                </div>
                                            </form>
                                        </td>

                                        <td>{{ $item->products->price * $item->prod_qty }}</td>

                                        <td><button class="delete-cart-item"><i class="fa fa-close"></i></button></td>
                                    </tr>
                                    @php $total += $item->products->price * $item->prod_qty @endphp
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="table-btn mt-4">

                        <a class="btn btn-border-black ms-auto" href="#">Update Cart</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="order-summary">
                                <h5 class="title">ORDER SUMMARY</h5>
                                <div class="subtotal">
                                    <span>Subtotal:</span>
                                    <span class="ms-auto">${{ $total }}</span>
                                </div>
                                <div class="subtotal">
                                    <span>Shipping Cost:</span>
                                    <span class="ms-auto">$10</span>
                                </div>
                                <div class="total">
                                    <span>Total:</span>
                                    <span class="ms-auto">${{ $total + 10 }}</span>
                                </div>
                                <a class="btn btn-title w-100" href="#">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area start -->
@endsection
