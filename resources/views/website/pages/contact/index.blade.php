@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/contact.css" />
@endpush
@section('title', 'Contact')

@section('content')
    <!-- contact section  -->
    <section class="contact py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-12 col-lg-8">
                    <div class="contact_head">
                        <h3>Have a Questions? Get in Touch</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                            et ultricies est. Aliquam in justo varius, sagittis neque ut,
                            malesuada leo.
                        </p>
                        <form action="">
                            <div class="d-flex gap-4">
                                <div class="d-flex flex-column gap-2 w-50">

                                    <div class="input_container input_contact">
                                        <input type="text" placeholder="example@gmail.com" />
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-2 w-50 mb-4">

                                    <div class="input_container input_contact">
                                        <input type="text" placeholder="example@gmail.com" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <div class="input_container input_contact">
                                    <textarea name="" id="" placeholder="Your Message" rows="5"></textarea>
                                </div>
                            </div>
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
                            <p class="icon-detailes">Example@gmail.com</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="contact_icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <p class="icon-detailes">
                                adipiscing elit. Mauris et ultricies est. Aliquam in justo
                                varius,
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
