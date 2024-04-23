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
                            <li class="breadcrumb-item active" aria-current="page"><b> Add Category</b></li>
                        </ol>
                    </nav>
                </div>

                <div class="ms-auto text-end">
                    <div class="btn-group">
                        <a href="{{ url('products') }}" class="btn btn-primary">Products List</a>
                    </div>
                </div>

            </div>
            <hr />

            <div class="card">
                <div class="card-body">
                    <form action="{{ url('update-Products/' . $Products->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category_id" class="col-form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value=""><b>Select a Category</b></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $Products->subcategory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="subcategory_id" class="col-form-label">SubCategory</label>
                                <select class="form-select" id="subcategory_id" name="subcategory_id">
                                    <option value=""><b>Select a SubCategory</b></option>

                                    @foreach ($subcategories as $subcategory)
                                        {{-- @php
                                            echo '<pre>';
                                            print_r($subcategory->category->id);
                                            exit();
                                        @endphp --}}

                                        @if ($subcategory->category_id == $subcategory->category->id)
                                        <option value="{{ $subcategory->id }}"
                                            {{ $Products->subcategory->id == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endif
                                    @endforeach

                                </select>
                                @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $Products->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="col-form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ $Products->slug }}">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="col-md-6">
                                <label for="title" class="col-form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $Products->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Small Description</label>


                                <textarea class="form-control" id="small_description" name="small_description">{{ $Products->small_description }}</textarea>
                                @error('small_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="col-form-label">Large Description</label>

                                <textarea class="form-control" id="description" name="description">{{ $Products->description }}</textarea>

                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ $Products->price }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="col-form-label">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty"
                                    value="{{ $Products->qty }}">
                                @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="additional_info" class="col-form-label">Additional Info</label>
                                <textarea class="form-control" id="additional_info" name="additional_info">{{ $Products->additional_info }}</textarea>

                                @error('additional_info')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="shipping_delivery" class="col-form-label">Shipping & Delivery</label>
                                <textarea class="form-control" id="shipping_delivery" name="shipping_delivery">{{ $Products->shipping_delivery }}</textarea>
                                @error('shipping_delivery')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ $Products->price }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                         

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status"
                                        {{ $Products->status == 1 ? 'checked' : '' }} value="1">
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <label for="image" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>


                                @if ($Products->image)
                                    <img src="{{ asset('images/products/' . $Products->image) }}" height="100px"
                                        width="100px">
                                @endif

                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-2" name="add_user_btn">Submit</button>
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
