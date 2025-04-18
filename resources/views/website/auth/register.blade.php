@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/register.css" />
@endpush
@section('title', 'Register')

@section('content')
<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <form method="POST" class="login-form" action="{{ route('front.auth.register.store') }}">
                            @csrf
                            <div class="d-flex flex-column gap-2  my-3  col-12">
                                <label for="email">Username</label>
                                <div class="">
                                    <input type="text" class="form-control" name="username" placeholder="John Smith"
                                        value="{{ old('username') }}" />
                                </div>
                                <x-error-form-input name="username"></x-error-form-input>
                            </div>

                            <div class="d-flex user-name gap-2 col-12">
                                <div class="d-flex flex-column gap-2   col-4">
                                    <label for="email">First Name</label>
                                    <div>
                                        <input type="text" class="form-control" name="first_name" placeholder="John"
                                            value="{{ old('first_name') }}" />
                                    </div>
                                    <x-error-form-input name="first_name"></x-error-form-input>
                                </div>

                                <div class="d-flex flex-column gap-2 col-4">
                                    <label for="email">Last Name</label>
                                    <div>
                                        <input type="text" class="form-control" name="last_name" placeholder="Smith"
                                            value="{{ old('last_name') }}" />
                                    </div>
                                    <x-error-form-input name="last_name"></x-error-form-input>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="email">Email</label>
                                <div>
                                    <input type="text" class="form-control" name="email" placeholder="example@gmail.com"
                                        value="{{ old('email') }}" />
                                </div>
                                <x-error-form-input name="email"></x-error-form-input>
                            </div>
                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="email">Password</label>
                                <div class="input-group mb-3 ">
                                    <input type="password" class="form-control passwordInput" name="password"
                                        placeholder="Enter password" />
                                    <div class="input-group-text">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                                <x-error-form-input name="password"></x-error-form-input>
                            </div>
                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="email">Confirm password</label>
                                <div class="input-group mb-3 ">
                                    <input type="password" class="form-control passwordInput"
                                        name="password_confirmation" placeholder="Enter password" />
                                    <div class="input-group-text">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="d-flex gap-1 align-items-center mt-3">
                                <div class="d-flex gap-2">
                                    <input type="checkbox" name="eememberme" id="rememberMe" />
                                    <label for="rememberMe">Agree with</label>
                                </div>
                                <p class="main_text">Terms & Conditions</p>
                            </div> --}}
                            <div>
                                <button type="submit" class="main_btn w-100 mt-3">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                        <p class="mt-4 text-center">
                            Already have an account?
                            <a href="{{ route('front.auth.login') }}" class="main_text">Login</a>
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