@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/register.css" />
@endpush
@section('title', __('website/auth.register'))

@section('content')
<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <form method="POST" class="login-form" action="{{ route('front.auth.register.store') }}">
                            @csrf
                            <div class="d-flex flex-column gap-2 my-3 col-12">
                                <label for="username">{{ __('website/auth.username') }}</label>
                                <div>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="{{ __('website/auth.enter_username') }}"
                                        value="{{ old('username') }}" />
                                </div>
                                <x-error-form-input name="username"></x-error-form-input>
                            </div>

                            <div class="d-flex user-name gap-2 col-12">
                                <div class="d-flex flex-column gap-2 col-4">
                                    <label for="first_name">{{ __('website/auth.first_name') }}</label>
                                    <div>
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="{{ __('website/auth.enter_firstname') }}"
                                            value="{{ old('first_name') }}" />
                                    </div>
                                    <x-error-form-input name="first_name"></x-error-form-input>
                                </div>

                                <div class="d-flex flex-column gap-2 col-4">
                                    <label for="last_name">{{ __('website/auth.last_name') }}</label>
                                    <div>
                                        <input type="text" class="form-control" name="last_name"
                                            placeholder="{{ __('website/auth.enter_lastname') }}"
                                            value="{{ old('last_name') }}" />
                                    </div>
                                    <x-error-form-input name="last_name"></x-error-form-input>
                                </div>
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="email">{{ __('website/auth.email') }}</label>
                                <div>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="{{ __('website/auth.enter_email') }}" value="{{ old('email') }}" />
                                </div>
                                <x-error-form-input name="email"></x-error-form-input>
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password">{{ __('website/auth.password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control passwordInput" name="password"
                                        placeholder="{{ __('website/auth.enter_password') }}" />
                                    <div class="input-group-text">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                                <x-error-form-input name="password"></x-error-form-input>
                            </div>

                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password_confirmation">{{ __('website/auth.confirm_password') }}</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control passwordInput"
                                        name="password_confirmation"
                                        placeholder="{{ __('website/auth.enter_password') }}" />
                                    <div class="input-group-text">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="main_btn w-100 mt-3">
                                    {{ __('website/auth.signup') }}
                                </button>
                            </div>
                        </form>

                        <p class="mt-4 text-center">
                            {{ __('website/auth.already_have_account') }}
                            <a href="{{ route('front.auth.login') }}" class="main_text">{{ __('website/auth.login')
                                }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection

@push('js')
<script>
    document.querySelectorAll('.fa-eye').forEach(icon => {
        icon.addEventListener('click', () => {
            const input = icon.closest('.input-group').querySelector('.passwordInput');
            if (input) {
                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('fa-eye-slash');
            }
        });
    });
</script>
@endpush