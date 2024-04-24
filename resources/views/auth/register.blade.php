
@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('assets/img/banner/b1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Register</h1>
                            <ul class="page-list">
                                <li><a href="#">HOME</a></li>
                                <li>Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <section class="checkout-area pt-5 pb-5" style="background-color: #F8F8F8;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ url('add_register') }}" method="POST">
                        @csrf
                        <div class="checkout-inner pd-bottom-50">
                            <h3 class="mb-3">Register Here</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Frist Name" name="first_name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Email id" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Password" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="">
                                        <label>
                                            <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> Other
                                        </label>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="col-lg-12">
                                    <div class="single-input-inner style-bg">
                                        <textarea placeholder="Address" name="address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <input type="submit" value="Register" class="btn btn-title">
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <a href="login.html">Already have an account? Login here</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- about area start -->
    @endsection


 
