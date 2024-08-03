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
                                    <th style="text-align: center;" >S.No</th>
                                    <th style="text-align: center;" >Category</th>
                                    <th style="text-align: center;" >SubCategory</th>
                                    <th style="text-align: center;" >Product Name</th>
                                    <th style="text-align: center;" >Title</th>
                                    <th style="text-align: center;" >Slug</th>
                                    <th style="text-align: center;" >Small Description</th>
                                    <th style="text-align: center;" >Large Description</th>
                                    <th style="text-align: center;" >Additional Info</th>
                                    <th style="text-align: center;" >Shipping & Delivery</th>
                                    <th style="text-align: center;" >Original Price</th>
                                    <th style="text-align: center;" >Selling Price</th>
                                    <th style="text-align: center;" >Quantity</th>
                                    <th style="text-align: center;" >image</th>
                                    <th style="text-align: center;" >Created At</th>
                                    <th style="text-align: center;" >status</th>
                                    <th style="text-align: center;"  scope="col" class="not-export-column">Action</th>
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
                                        <td>{{ $item->original_price }}</td>
                                        <td>{{ $item->selling_price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            @if (!empty($option_name->image))
                                                <img src="{{ asset('images/products/' . $option_name->image) }}"
                                                    alt="Product Image" width="100" height="100">
                                            @endif

                                        </td>
                                        <td>{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                                    
                                        <td>
                                            <input class="status-toggle" type="checkbox" data-user-id="{{ $item->id }}"
                                                data-status="{{ $item->status }}"
                                                @if ($item->status == 1) checked @endif data-onstyle="primary"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="Inactive">
                                        </td>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        var file_name = 'products';
        $('#categorytable').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBifrtip',
            buttons: [{
                    extend: 'pdf',
                    filename: file_name,
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    filename: file_name,
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }
            ],
            language: {
                infoEmpty: "Showing 0 to 0 of 0 Entries",
                info: "Showing _START_ to _END_ of _TOTAL_ Entries",
                lengthMenu: "Show _MENU_ Entries",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
        });
    });
    



    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var userId = $(this).data('user-id');

            var currentStatus = $(this).prop('checked') === true ? 1 : 0;
            //  console.log(currentStatus);

            // Passing 2 parameters in ajax url in Laravel route
            $.ajax({
                url: "{{ route('product-status', ['userId' => ':userId', 'currentStatus' => ':currentStatus']) }}"
                    .replace(':userId', userId)
                    .replace(':currentStatus', currentStatus),


                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    user_id: userId,
                    status: currentStatus
                },
                success: function(response) {
                    if (response.status == 'success') {
                        location.reload();
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText);
                    alert('Error occurred while updating status.');
                }
            });
        });
    });
</script>
