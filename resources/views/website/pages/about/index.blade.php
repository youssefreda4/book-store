@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/about.css" />
@endpush

@section('title', 'About')

@section('hero_content')
    <div class="search">
        <div>
            <div class="about">
                <h1 class="about_title">About Bookshop</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et
                    ultricies est. Aliquam in justo varius, sagittis neque ut,
                    malesuada leo.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- our mission -->
    <section class="missions py-5">
        <div class="container">
            <p class="head">Our Mission</p>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>Quality Selection</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                            et ultricies est. Aliquam in justo varius, sagittis neque ut,
                            malesuada leo.Quality SelectionLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Mauris et ultricies est. Aliquam in
                            justo varius,
                        </p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">view More</p>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>Quality Selection</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                            et ultricies est. Aliquam in justo varius, sagittis neque ut,
                            malesuada leo.Quality SelectionLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Mauris et ultricies est. Aliquam in
                            justo varius,
                        </p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">view More</p>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>Quality Selection</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                            et ultricies est. Aliquam in justo varius, sagittis neque ut,
                            malesuada leo.Quality SelectionLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Mauris et ultricies est. Aliquam in
                            justo varius,
                        </p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">view More</p>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- feature -->
    <section class="main_bg py-5">
        <div class="container py-4">
            <p class="head">Feature</p>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="./images/shipping.png" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>Fast & Reliable Shipping</h1>
                        </div>
                        <div class="feature_description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Mauris et ultricies est. Aliquam in justo varius, sagittis
                                neque ut, malesuada leo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="./images/credit-card-buyer.png" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>Secure Payment</h1>
                        </div>
                        <div class="feature_description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Mauris et ultricies est. Aliquam in justo varius, sagittis
                                neque ut, malesuada leo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="./images/restock.png" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>Easy Returns</h1>
                        </div>
                        <div class="feature_description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Mauris et ultricies est. Aliquam in justo varius, sagittis
                                neque ut, malesuada leo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="./images/user-headset.png" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>24/7 Customer Support</h1>
                        </div>
                        <div class="feature_description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Mauris et ultricies est. Aliquam in justo varius, sagittis
                                neque ut, malesuada leo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
