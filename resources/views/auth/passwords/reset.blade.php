@extends('layouts.front')

@section('content')

<div class="breadcrumb-area" style="background-image:url('assets/img/banner/b1.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <div class="section-title text-center mb-0">
                        <h1 class="page-title">Reset Password</h1>
                        <ul class="page-list">
                            <li><a href="{{ url('/') }}">HOME</a></li>
                            <li>Reset Password</li>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Token Input -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Input -->
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $email ?? '') }}" required readonly autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6 password-container">
                                    <input id="password" type="password"
                                        class="form-control" name="password">
                                    <i class="fa fa-eye icon-eye toggle-password"
                                        onclick="togglePassword('password', this)"></i>

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="row mb-3">
                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6 password-container">
                                    <input id="password_confirmation" type="password"
                                        class="form-control"
                                        name="password_confirmation">
                                    <i class="fa fa-eye icon-eye toggle-password"
                                        onclick="togglePassword('password_confirmation', this)"></i>

                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection