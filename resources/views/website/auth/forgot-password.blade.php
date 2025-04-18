@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', 'Forget Password')

@section('content')

<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <p class="text-center main_text fw-bold py-4">Forgot Your Password?</p>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if(session('errorForm'))
                            <div class="alert alert-danger">{{ session('errorForm') }}</div>
                        @endif

                        <form action="{{ route('front.auth.password.email') }}" method="POST" class="login-form" novalidate>
                            @csrf
                            <div class="d-flex flex-column gap-2">
                                <label for="email">Email Address</label>
                                <div>
                                    <input type="email" name="email" id="email"  class="form-control" placeholder="example@gmail.com"
                                           value="{{ old('email') }}" autocomplete="email" autofocus required />
                                </div>
                                <x-error-form-input name="email" />
                            </div>

                            <div>
                                <button type="submit" class="main_btn w-100 mt-4">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </form>

                        <p class="mt-4 text-center">
                            Remembered your password?
                            <a href="{{ route('front.auth.login') }}" class="main_text">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

@endsection
