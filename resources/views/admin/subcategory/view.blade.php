<head>
    <style>
        /* b {
            color: black;
            background: 20px;

            font-size: 25px;
            /* Set the font size here */
        } */
    </style>
</head>
@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Sub Categories</b></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('add-subcategory') }}" class="btn btn-primary">Add Sub Category</a>
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
                                    <th>SubCategory Name</th>
                                    <th>Date</th>
                                    <th scope="col" class="not-export-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                      
                                @foreach ($subcategories as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->category->name }}</td> 
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d-m-y h:i:s A', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('edit-subcategory/' . $item->id) }}"
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
