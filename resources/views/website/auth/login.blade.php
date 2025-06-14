@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/login.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
@endpush
@section('title', __('website/auth.login'))

@section('content')
<section class="library my-5">
    <div class="container">
        <section class=" py-5">
            <div class="container">
                <p class="text-center main_text fw-bold py-4">{{ __('website/auth.welcome_back') }}</p>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                       
                        @session('errorForm')
                        <div class="alert alert-danger">{{ session('errorForm') }}</div>
                        @endsession

                        <form action="{{ route('login.check') }}" method="POST" class="login-form">
                            @csrf
                            <div class="d-flex flex-column gap-2">
                                <label for="email">{{ __('website/auth.email') }}</label>
                                <div>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="{{ __('website/auth.enter_email') }}" value="{{ old('email') }}" />
                                </div>
                                <x-error-form-input name="email"></x-error-form-input>
                            </div>
                            <div class="d-flex flex-column gap-2 my-3">
                                <label for="password">{{ __('website/auth.password') }}</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control passwordInput"
                                        placeholder="{{ __('website/auth.enter_password') }}" />
                                    <div class="input-group-text">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                                <x-error-form-input name="password"></x-error-form-input>
                            </div>
                            <div class="d-flex justify-content-between align-items center mt-3">
                                <div>
                                    {{-- <label for="rememberMe">Remember me</label> --}}
                                </div>
                                <a href="{{route("password.request")}}" class="main_text">{{ __('website/auth.forget_password') }}</a>
                            </div>

                            <!-- Social Login Buttons Row -->
                            <div class="d-flex justify-content-between mt-4">
                                @foreach (config('social.providers') as $provider)
                                <a href="{{ route('redirect',['driver' => $provider['driver']]) }}"
                                    class="test-center flex-grow-1 me-2  {{ $provider['color'] }} text-white ">
                                    <i class="{{ $provider['icon'] }} me-2"></i>
                                    {{ __('website/auth.login_with_'.strtolower($provider['name'])) }}
                                </a>
                                @endforeach
                            </div>

                            <div>
                                <button type="submit" class="main_btn w-100 mt-3">
                                    {{  __('website/auth.login') }}
                                </button>
                            </div>
                        </form>
                        <p class="mt-4 text-center">
                          {{  __('website/auth.dont_have_account') }}
                            <a href="{{ route('register') }}" class="main_text">{{  __('website/auth.signup') }}</a>
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