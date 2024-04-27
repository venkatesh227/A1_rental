@extends('layouts.front')
@section('content')
    <!-- Banner Starts -->
    <div class="breadcrumb-area" style="background-image:url('{{ asset('fronted/img/banner/b1.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title text-center mb-0">
                            <h1 class="page-title">Contact Us</h1>
                            <ul class="page-list">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li>CONTACT US</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <div class="product-area">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="vertical-menu">
                        <a href="{{ url('/') }}" class="active">Home</a>
                        <a href="#">About</a>
                        <a href="#">Services</a>
                        <a href="{{ url('email') }}">Contact</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="contact100-form-title">Contact Form</h4>
                                    <form action="{{ url('send-mail') }}" method="POST">
                                        @csrf
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                                        @endif
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="text" name="name" placeholder="Name">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="text" name="email" placeholder="Email">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="text" name="subject" placeholder="Subject">
                                            @error('subject')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <textarea class="form-control" name="content" placeholder="Message"></textarea>
                                            @error('content')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- about area start -->
    @endsection
