<head>
    <style>
        /* b {
            color: black;
            background: 20px;

            font-size: 25px;
            /* Set the font size here
        } */
    </style>
</head>
@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">



            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><b> Add Images</b></li>
                        </ol>
                    </nav>
                </div>

            </div>
            <hr />
            <div class="card">
                <div class="col-md-6">
                    <div class="card-body">
                        <form action="{{ url('add-product-images/' . $product_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="image" class="col-form-label">Images<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple="multiple"
                                    value="{{ old('image') }}" accept="image/jpeg, image/png ,image/jpg">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mt-2" name="add_user_btn">Submit</button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="categorytable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Images</th>
                                <th class="not-export-column">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($product_images as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if (!empty($item->image))
                                            <img src="{{ asset('images/product_images/' . $item->image) }}"
                                                alt="Product Image" width="100" height="100">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-product-image/' . $item->id) }}"
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
        var file_name = 'products_images';
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
</script>
