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



            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><b> Add SubCategory</b></li>
                        </ol>
                    </nav>
                </div>

            </div>

            <hr />



            <div class="card">
                <div class="col-md-6">
                <div class="card-body">
                    <form action="{{ url('insert-subcategory') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <label class="col-md-12 col-form-label">Category<span style="color: red;">*</span></label>

                            <div class="col-md-12">
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value=""><b>Select a Category</b></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <label class="col-md-12 mt-2">Subcategory<span style="color: red;">*</span></label>
                            <div class="col-md-12 mt-2">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                                <div class="col-md-12">
                                    <label for="image" class="col-form-label">Image<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ old('image') }}">
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







        </div>
    </div>
@endsection
