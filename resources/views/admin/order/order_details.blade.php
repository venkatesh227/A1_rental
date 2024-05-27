@extends('admin.index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-5">
                    <div class="card-header bg-primary">
                        <span class="text-white fs-4"> View Order</span>
                        <a href="{{ url('orders') }}" class="btn btn-warning float-end"> <i class="fa fa-reply"></i>Back</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">Delivery Details</h4>
                                <hr>
                                <div class="container col-md-9">
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
                               
                                <form action="{{ url('update_order_status/' . $orderDetails[0]->Orders->id) }}" method="POST">
                                    @csrf
                                    <label class="fw-bold">
                                        <h4>Order Status</h4>
                                    </label>
                                    <select name="order_status" id="order_status" class="form-select">
                                        <option value="0" {{ $orderDetails[0]->Orders->status == 0 ? 'selected' : '' }}>Under Process</option>
                                        <option value="1" {{ $orderDetails[0]->Orders->status == 1 ? 'selected' : '' }}>Accepted</option>
                                        <option value="2" {{ $orderDetails[0]->Orders->status == 2 ? 'selected' : '' }}>Completed</option>
                                        <option value="3" {{ $orderDetails[0]->Orders->status == 3 ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    
                                    <button type="submit" name="update_order_status_btn"
                                        class="btn btn-primary float-end mt-3">Update Status</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
