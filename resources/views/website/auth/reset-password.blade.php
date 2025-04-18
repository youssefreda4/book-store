@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', 'Reset Password')

@section('content')
<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <p class="text-center main_text fw-bold py-4">Reset Your Password</p>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('front.auth.password.update') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="d-flex flex-column gap-2">
                                <label for="email">Email Address</label>
                                <div class="input_container">
                                    <input type="email" name="email" id="email" placeholder="example@gmail.com"
                                           value="{{ old('email') }}" autocomplete="email" autofocus />
                                </div>
                                <x-error-form-input name="email" />
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password">New Password</label>
                                <div class="input_container">
                                    <input type="password" name="password" id="password" placeholder="Enter new password" />
                                </div>
                                <x-error-form-input name="password" />
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password_confirmation">Confirm New Password</label>
                                <div class="input_container">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter new password" />
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="main_btn w-100 mt-3">
                                    Reset Password
                                </button>
                            </div>
                        </form>

                        <p class="mt-4 text-center">
                            Go back to <a href="{{ route('front.auth.login') }}" class="main_text">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
