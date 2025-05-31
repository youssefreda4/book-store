@extends('website.layouts.main')

@push('css')
<link rel="stylesheet" href="{{ asset('front-assets/css/contact.css') }}" />
@endpush

@section('title', __('website/contact.contact'))

@section('content')
<!-- contact section  -->
<section class="contact py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-8">
                <div class="contact_head">
                    <h3>{{ __('website/contact.have_question') }}</h3>
                    <p>{{ __('website/contact.contact_description') }}</p>

                    <form action="{{ route('front.contact.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="d-flex gap-4">
                            <div class="d-flex flex-column gap-2 w-50">
                                <div class="input_container input_contact">
                                    <input type="text" name="name" placeholder="{{ __('website/contact.name') }}"
                                        required />
                                    </div>
                                    <x-error-input name="name"></x-error-input>
                            </div>
                            <div class="d-flex flex-column gap-2 w-50 mb-4">
                                <div class="input_container input_contact">
                                    <input type="email" name="email" placeholder="{{ __('website/contact.email') }}"
                                        required />
                                    </div>
                                    <x-error-input name="email"></x-error-input>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="input_container input_contact">
                                <textarea name="message" placeholder="{{ __('website/contact.message') }}" rows="5"
                                    required></textarea>
                                    
                                </div>
                                <x-error-input name="message"></x-error-input>
                            </div>
                        <button type="submit" class="btn btn-primary mt-3">{{ __('website/contact.send_message')
                            }}</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3">
                        <div class="contact_icon">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <p class="icon-detailes">01123456789</p>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="contact_icon">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <p class="icon-detailes">example@gmail.com</p>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="contact_icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p class="icon-detailes">{{ __('website/contact.address_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection