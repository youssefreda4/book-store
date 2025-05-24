@extends('website.layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('front-assets/css/about.css') }}" />
@endpush

@section('title', __('website/about.about'))

@section('hero_content')
    <div class="search">
        <div>
            <div class="about">
                <h1 class="about_title">{{ __('website/about.about_bookshop') }}</h1>
                <p>{{ __('website/about.about_text') }}</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
@php
    $locale = app()->getLocale();
@endphp
    <!-- our mission -->
    <section class="missions py-5">
        <div class="container">
            <p class="head">{{ __('website/about.our_mission') }}</p>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>{{ __('website/about.mission_1_title') }}</h2>
                        <p>{{ __('website/about.mission_1_text') }}</p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">{{ __('website/about.view_more') }}</p>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>{{ __('website/about.mission_2_title') }}</h2>
                        <p>{{ __('website/about.mission_2_text') }}</p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">{{ __('website/about.view_more') }}</p>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mission">
                        <h2>{{ __('website/about.mission_3_title') }}</h2>
                        <p>{{ __('website/about.mission_3_text') }}</p>
                        <a href="#" class="d-flex gap-2 align-items-center">
                            <p class="m-0">{{ __('website/about.view_more') }}</p>
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
            <p class="head">{{ __('website/about.feature') }}</p>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="{{ asset('images/shipping.png') }}" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>{{ __('website/about.shipping_title') }}</h1>
                        </div>
                        <div class="feature_description">
                            <p>{{ __('website/about.shipping_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="{{ asset('images/credit-card-buyer.png') }}" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>{{ __('website/about.secure_payment_title') }}</h1>
                        </div>
                        <div class="feature_description">
                            <p>{{ __('website/about.secure_payment_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="{{ asset('images/restock.png') }}" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>{{ __('website/about.easy_returns_title') }}</h1>
                        </div>
                        <div class="feature_description">
                            <p>{{ __('website/about.easy_returns_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature">
                        <div class="feature_icon">
                            <img src="{{ asset('images/user-headset.png') }}" alt="" />
                        </div>
                        <div class="feature_title">
                            <h1>{{ __('website/about.support_title') . ' ' .translateNumberToLocale($locale,24,0).'/'.translateNumberToLocale($locale,7,0) }}</h1>
                        </div>
                        <div class="feature_description">
                            <p>{{ __('website/about.support_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
