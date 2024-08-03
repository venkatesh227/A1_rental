@extends('admin.index')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><b>Edit SubCategory</b></li>
                        </ol>
                    </nav>
                </div>


                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('subcategories') }}" class="btn btn-primary">SubCategory List</a>
                    </div>
                </div>

            </div>
            <hr />
            <div class="card">
                <div class="col-md-6">
                    <div class="card-body">
                        <form action="{{ url('upadate-subcategory/' . $subcategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-center">
                                <label class="col-md-12 col-form-label">Category</label>
                                <div class="col-md-12">
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value=""><b>Select a Category</b></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <label class="col-md-12 mt-2">Subcategory</label>
                                <div class="col-md-12 mt-2">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $subcategory->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label for="image" class="col-form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" value="">

                                    @if ($subcategory->image)                                
                                    <img src="{{ asset('images/subcategories/' . $subcategory->image) }}" height="100px" width="100px">
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary mt-2"
                                        name="update_subcategory_btn">Submit</button>
                                        <a href="{{ url('add-subcategory') }}" class="btn btn-light mt-2">Reset</a>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
