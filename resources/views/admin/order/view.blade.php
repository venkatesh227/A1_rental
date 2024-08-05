@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Order Details</b></li>
                        </ol>
                    </nav>
                </div>

            </div>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="orders_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" >Sl. No</th>
                                    <th style="text-align: center;" >Order Date</th>
                                    <th style="text-align: center;" >Tracking Number</th>
                                    <th style="text-align: center;" >Total Price</th>
                                    <th style="text-align: center;" >Status</th>
                                    <th style="text-align: center;" >Action</th>
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
                                            <a href="{{ url('view_order/' . $value->id . '/' . $value->user_id) }}"
                                                class="btn btn-primary">View</a>
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
        var file_name = 'orders_lists';
        $('#orders_table').DataTable({
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
