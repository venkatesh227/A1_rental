@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Products</b></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('add-product') }}" class="btn btn-primary">Add Product</a>

                    </div>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="categorytable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Product Name</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Small Description</th>
                                    <th>Large Description</th>
                                    <th>Additional Info</th>
                                    <th>Shipping & Delivery</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>status</th>
                                    <th>image</th>
                                    <th>Created At</th>

                                    <th scope="col" class="not-export-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                @foreach ($products as $item)
                                    @php
                                        $product_id = $item->id;
                                        $option_name = \App\Models\Product_images::Where(
                                            'product_id',
                                            $product_id,
                                        )->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->subcategory->category->name }}</td>
                                        <td>{{ $item->subcategory->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ $item->small_description }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->additional_info }}</td>
                                        <td>{{ $item->shipping_delivery }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if (!empty($option_name->image))
                                                <img src="{{ asset('images/products/' . $option_name->image) }}"
                                                    alt="Product Image" width="100" height="100">
                                            @endif

                                        </td>
                                        <td>{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('edit-product/' . $item->id) }}"
                                                class="btn btn-primary">Edit</a>
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
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categorytable').DataTable();
    });
</script>
