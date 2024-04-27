@extends('layouts.front')
@section('content')
    <div class="breadcrumb-area" style="background-image: url('{{ asset('fronted/img/banner/b1.jpg') }}')">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">My Orders</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>MY ORDERS</li>

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
                        <a href="{{ url('/') }}" class="active">Home</a>
                        <a href="#">About</a>
                        <a href="#">Services</a>
                        <a href="{{ url('email') }}">Contact</a>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="row gy-5 justify-content-center">


                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="client_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl. No</th>
                                                <th>Order Date</th>
                                                <th>Tracking Number</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($orders as $value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                                                    <td>{{ $value->order_no }}</td>
                                                    <td>{{ $value->grand_total }}</td>
                                                    {{-- <td>{{ $value->status }}</td> --}}
                                                    <td>
                                                        @if ($value->status == 0)
                                                            Under Process
                                                        @elseif($value->status == 1)
                                                            Accepted
                                                        @elseif($value->status == 2)
                                                            Completed
                                                        @elseif($value->status == 3)
                                                            Cancelled
                                                        @else
                                                            Unknown Status
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('view_my_order/' . $value->id . '/' . $value->user_id) }}"
                                                            class="btn btn-title">View</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
