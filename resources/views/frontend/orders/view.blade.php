@extends('layouts.front')
@section('content')
    <div class="breadcrumb-area" style="background-image: url('{{ asset('fronted/img/banner/b1.jpg') }}')">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Orders View</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>MY ORDERS</li>
                                <li>DETAILS</li>

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="vertical-menu">
                            <a href="{{ url('/') }}" class="active">Home</a>
                            <a href="#">About</a>
                            <a href="#">Services</a>
                            <a href="{{ url('email') }}">Contact</a>
                        </div>
                    </div>


                    <div class="col-md-9">
                        <div class="row  justify-content-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">Delivery Details</h4>
                                    <hr>
                                    <div class="container">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="fw-bold">Frist Name</th>
                                                    <td>{{ $userDetails->first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Last Name</th>
                                                    <td>{{ $userDetails->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Email</th>
                                                    <td>{{ $userDetails->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Phone</th>
                                                    <td>{{ $userDetails->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Gender</th>
                                                    <td>{{ $userDetails->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Address</th>
                                                    <td>{{ $userDetails->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetails as $item)
                                                @php
                                                    $product_id = $item->product_id;
                                                    $option_name = \App\Models\Product_images::Where(
                                                        'product_id',
                                                        $product_id,
                                                    )->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->Product->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ '$' . $item->single_price }}</td>
                                                    <td>
                                                        @if (!empty($option_name->image))
                                                            <img class="image-item-01"
                                                                src="{{ asset('images/products/' . $option_name->image) }}"
                                                                alt="Product Image" width="100" height="100">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4>Total Price : <span
                                            class="float-end">{{ '$' . $orderDetails[0]->Orders->grand_total }}</span></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="fw-bold">
                                                <h4>Order Status</h4>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="order_status" id="order_status" class="form-control"
                                                value="@if ($orderDetails[0]->Orders->status == 0) Under Process
                                              @elseif($orderDetails[0]->Orders->status == 1)
                                                  Accepted
                                              @elseif($orderDetails[0]->Orders->status == 2)
                                                  Completed
                                              @elseif($orderDetails[0]->Orders->status == 3)
                                                  Cancelled @endif"
                                                readonly>
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
@endsection
