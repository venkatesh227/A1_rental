
@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('assets/img/banner/b1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Login or Register User</h1>
                            <ul class="page-list">
                                <li><a href="#">HOME</a></li>
                                <li>Login or Register</li>
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
                    <div class="checkout-inner pd-bottom-50">
                        <h3 class="mb-3">Login</h3>
                        <form action="{{ url('user-login-check') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-bg">
                                            <input type="text" placeholder="User Name" name="phone">
                                        </div>
                                        <span class="text-danger mt-1">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-bg">
                                            <input type="text" placeholder="Password" name="password">
                                        </div>
                                        <span class="text-danger mt-1 ">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-title">
                                            Login
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="text-right pull-right" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <a href="{{ url('register') }}">Dont have an account? Register here</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area start -->
    @endsection



