@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', __('website/auth.reset_password'))

@section('content')
<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <p class="text-center main_text fw-bold py-4">{{ __('website/auth.reset_your_password') }}</p>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="d-flex flex-column gap-2">
                                <label for="email">{{ __('website/auth.email') }}</label>
                                <div class="input_container">
                                    <input type="email" name="email" id="email" placeholder="{{ __('website/auth.enter_email') }}"
                                           value="{{ old('email') }}" autocomplete="email" autofocus />
                                </div>
                                <x-error-form-input name="email" />
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password">{{ __('website/auth.new_password') }}</label>
                                <div class="input_container">
                                    <input type="password" name="password" id="password" placeholder="{{ __('website/auth.enter_new_password') }}" />
                                </div>
                                <x-error-form-input name="password" />
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password_confirmation">{{ __('website/auth.confirm_new_password') }}</label>
                                <div class="input_container">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('website/auth.re_enter_new_password') }}" />
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="main_btn w-100 mt-3">
                                   {{__('website/auth.reset_password')}}
                                </button>
                            </div>
                        </form>

                        <p class="mt-4 text-center">
                           {{ __('website/auth.go_back_to') }} <a href="{{ route('login') }}" class="main_text">{{ __('website/auth.login') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
