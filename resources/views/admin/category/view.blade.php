@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Categories</b></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('add-category') }}" class="btn btn-primary">Add Category</a>
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
                                    <th style="text-align: center;" >Sl. No</th>
                                    <th style="text-align: center;" >Category Name</th>
                                    <th style="text-align: center;" >Image</th>
                                    <th style="text-align: center;" >Created At</th>
                                    <th style="text-align: center;"  scope="col" class="not-export-column">Action</th>
                                    <th style="text-align: center;" >Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($category as $item)
                                    <tr>
                                        <td>{{ $i++; }}</td>
                                        <td>{{ $item->name }}</td>

                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset('images/categories/' . $item->image) }}"
                                                    alt="Product Image" width="100" height="100">
                                            @endif
                                        </td>

                                        <td>{{ date('d-m-y h:i:s A', strtotime($item->created_at)) }}</td>

                                        <td>
                                            <a href="{{ url('edit-category/' . $item->id) }}"
                                                class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <input class="status-toggle" type="checkbox" data-user-id="{{ $item->id }}"
                                                data-status="{{ $item->status }}"
                                                @if ($item->status == 1) checked @endif data-onstyle="primary"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="Inactive">
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



    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var userId = $(this).data('user-id');

            var currentStatus = $(this).prop('checked') === true ? 1 : 0;
    
            $.ajax({
                url: "{{ route('category-status', ['userId' => ':userId', 'currentStatus' => ':currentStatus']) }}"
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
