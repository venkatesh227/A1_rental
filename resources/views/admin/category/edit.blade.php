<head>
    <style>
        b {
            color: black;
            background: 20px;
            font-size: 20px;
        }
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
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('categories') }}" class="btn btn-primary">Category List</a>
                    </div>
                </div>
            </div>

            <hr />
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Edit Category</h5>
                    <form action="{{ url('upadate-category/' . $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Category Name"
                                value="{{ $category->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                <a href="{{ url('add-category') }}" class="btn btn-light mt-2">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
