<head>
    <style>
        /* b {
            color: black;
            background: 20px;

            font-size: 25px;
            /* Set the font size here 
        }*/
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
                            <li class="breadcrumb-item active" aria-current="page"><b> Add Product</b></li>
                        </ol>
                    </nav>
                </div>

            </div>

            <hr />

            <div class="card">
                <div class="card-body">
                    <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category_id" class="col-form-label">Category<span style="color: red;">*</span></label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value=""><b>Select a Category</b></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="subcategory_id" class="col-form-label">SubCategory<span style="color: red;">*</span></label>
                                <select class="form-select" id="subcategory_id" name="subcategory_id">
                                    <option value=""><b>Select a SubCategory</b></option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Product Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="col-form-label">Slug<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="title" class="col-form-label">Title<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="small_description" class="col-form-label">Small Description<span style="color: red;">*</span></label>
                                <textarea class="form-control" id="small_description" name="small_description">{{ old('small_description') }}</textarea>

                                @error('small_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="description" class="col-form-label">Large Description<span style="color: red;">*</span></label>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>


                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="additional_info" class="col-form-label">Additional Info<span style="color: red;">*</span></label>
                                <textarea class="form-control" id="additional_info" name="additional_info">{{ old('additional_info') }}</textarea>

                                @error('additional_info')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="shipping_delivery" class="col-form-label">Shipping & Delivery<span style="color: red;">*</span></label>
                                <textarea class="form-control" id="shipping_delivery" name="shipping_delivery">{{ old('shipping_delivery') }}</textarea>
                                @error('shipping_delivery')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="price" class="col-form-label">Original Price<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="original_price" name="original_price"
                                    value="{{ old('original_price') }}">
                                @error('original_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="col-md-6">
                                <label for="selling_price" class="col-form-label">Selling Price<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="selling_price" name="selling_price"
                                    value="{{ old('selling_price') }}">
                                @error('selling_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                         

                            <div class="col-md-6">
                                <label for="qty" class="col-form-label">Quantity<span style="color: red;">*</span></label>
                                <input type="number" class="form-control" id="qty" name="qty"
                                    value="{{ old('qty') }}">
                                @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            {{-- <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status"
                                        value="1">
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <label for="image" class="col-form-label">Images</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple value="{{ old('image') }}">
                                @error('image')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary mt-2" name="add_user_btn">Submit</button>
                                <a href="{{ url('add-product') }}" class="btn btn-light mt-2">Reset</a>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var category_id = $(this).val();

            $("#subcategory_id").html('<option value="">Select SubCategory</option>');
            $.ajax({
                url: "{{ route('fetchSubcategories') }}",
                type: "POST",
                data: {
                    category_id: category_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    $.each(result.subcategories, function(key, value) {
                        $("#subcategory_id").append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
