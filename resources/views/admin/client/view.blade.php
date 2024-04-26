@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Client Details</b></li>
                        </ol>
                    </nav>
                </div>

            </div>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="client_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($users as $value)
                                    <tr>
                                        <td>{{ $i++; }}</td>
                                        <td>{{ $value->first_name }}</td>
                                        <td>{{ $value->last_name }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <input class="status-toggle" type="checkbox" data-user-id="{{ $value->id }}"
                                                data-status="{{ $value->status }}"
                                                @if ($value->status == 1) checked @endif data-onstyle="primary"
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
        $('#client_table').DataTable();
    });


    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var userId = $(this).data('user-id');

            var currentStatus = $(this).prop('checked') === true ? 1 : 0;

            // Passing 2 parameters in ajax url in Laravel route
            $.ajax({
                url: "{{ route('update-status', ['userId' => ':userId', 'currentStatus' => ':currentStatus']) }}"
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
