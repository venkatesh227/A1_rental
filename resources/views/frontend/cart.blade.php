@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/b1.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Cart Details</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
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
                <form action="{{ url('place-order') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($cartitems->count() > 0)
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
                                                <td class="price">${{ number_format($item->products->selling_price, 2) }}</td>
                                                <td class="table-quantity">
                                                    <form>
                                                        <div class="quantity buttons_added">
                                                            <input type="hidden" name=""
                                                                value="{{ $item->prod_id }}" class="prod_id">
                                                            <input type="button" value="-"
                                                                class="minus changeqty decrement-btn">
                                                            <input type="number" step="1" min="1"
                                                                max="10000" name="quantity" class="input-qty"
                                                                value="{{ $item->prod_qty }}">
                                                            <input type="button" value="+"
                                                                class="plus changeqty increment-btn ">
                                                        </div>
                                                    </form>
                                                </td>

                                                <td>${{ number_format((float) $item->products->selling_price * (int) $item->prod_qty, 2) }}
                                                </td>


                                                <td><button class="delete-cart-item"><i class="fa fa-close"></i></button>
                                                </td>
                                            </tr>
                                            @php $total += (float)$item->products->selling_price * (int)$item->prod_qty; @endphp
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
                                            <span class="ms-auto">${{ number_format($total, 2) }}</span>
                                        </div>
                                        <div class="subtotal">
                                            <span>Shipping Cost:</span>
                                            <span class="ms-auto">$10.00</span>
                                        </div>
                                        <div class="total">
                                            <span>Total:</span>
                                            <span class="ms-auto">${{ number_format($total + 10, 2) }}</span>
                                        </div>
                                        <input type="hidden" name="no_of_products" value="{{ $cartitems->count() }}">
                                        <input type="hidden" name="grand_total" value="{{ $total }}">
                                        <button type="submit" class="btn btn-title w-100">PROCEED TO CHECKOUT</button>
                                    </div>
                                </div>
                            </div>

                </form>
            @else
                <div class="card-body text-center">
                    <div class="alert alert-danger">
                        <h4>Your Cart Is Empty</h4>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary float-end">Continue
                        Shopping</a>
                </div>
                @endif


            </div>
        </div>
    </div>
    </div>
    <!-- about area start -->
@endsection
