@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', __('website/auth.verify_email'))

@section('content')
<section class="library my-5">
    <div class="container">
        <section class="py-5">
            <div class="container">
                <p class="text-center main_text fw-bold py-4">{{  __('website/auth.verify_your_email') }}</p>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">

                        @session('errorForm')
                        <div class="alert alert-danger text-center">{{ session('errorForm') }}</div>
                        @endsession

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-center">{{ $error }}</div>
                            @endforeach
                        @endif

                        <p class="text-center text-muted mb-4">{{  __('website/auth.enter_the_six_digit_otp_sent_to_your_email') }}</p>

                        <form id="otpForm" action="{{ route('email.send.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="d-flex justify-content-center gap-2 mb-4">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input
                                        type="text"
                                        maxlength="1"
                                        name="otp[]"
                                        pattern="[0-9]"
                                        class="form-control otp-input text-center fw-bold"
                                        style="width: 50px; height: 50px; font-size: 1.5rem;"
                                        required
                                    >
                                @endfor
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="main_btn px-5">{{  __('website/auth.verify') }}</button>
                            </div>
                        </form>

                        @error('otp')
                            <div class="text-danger text-center mt-3">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection


@push('js')
    <script>
        // Select all OTP input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpForm = document.getElementById('otpForm');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.match(/[^0-9]/)) { // Only allow numeric input
                    input.value = ''; // Clear invalid input
                }
                
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus(); // Move to next input on valid input
                }
                
                if (Array.from(otpInputs).every(i => i.value.length === 1)) {
                    otpForm.submit(); // Submit the form when all inputs are filled
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    otpInputs[index - 1].focus(); // Move to previous input on Backspace
                }
            });
        });
    </script>
@endpush