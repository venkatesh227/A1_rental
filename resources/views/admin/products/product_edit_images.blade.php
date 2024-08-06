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
                            <li class="breadcrumb-item active" aria-current="page"><b> Edit Images</b></li>
                        </ol>
                    </nav>
                </div>

            </div>
            <hr />
            <div class="card">
                <div class="col-md-6">
                    <div class="card-body">
                        <form action="{{ url('update_product_images/' . $product_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="image" class="col-form-label">Images<span
                                        style="color: red;">*</span></label>
                                <input type="file" class="form-control" id="image" name="image"
                                    value="{{ old('image') }}" accept="image/jpeg, image/png ,image/jpg">
                                @if (!empty($product_id))
                                    @php
                                        $product_images = \App\Models\ProductImages::where('id', $product_id)->get();
                                    @endphp

                                    @if ($product_images->isNotEmpty())
                                        @foreach ($product_images as $image)
                                            @if (!empty($image->image))
                                                <img src="{{ asset('images/product_images/' . $image->image) }}"
                                                    alt="Product Image" width="100" height="100">
                                            @else
                                                <p>No image available.</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No images found for product_id {{ $product_id }}.</p>
                                    @endif
                                @endif
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
