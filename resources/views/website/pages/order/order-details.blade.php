@extends('website.layouts.main')

@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/orders.css" />
@endpush

@section('title', __('website/orders.order_detalis'))

@section('content')
@php
$locale = app()->getLocale();
@endphp
<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5">
                        <h5 class="text-muted mb-0">
                            {{ __('website/orders.thanks', ['name' => $order->user->first_name]) }}
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0" style="color: #a8729a;">{{ __('website/orders.receipt') }}
                            </p>
                        </div>
                        @foreach ($order->books as $book)
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ $book->getFirstMediaUrl('book', 'preview') }}" class="img-fluid"
                                            alt="Book Image">
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{ $book->name }}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">{{ $book->author->name }}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">{{ __('website/orders.quantity') }} : {{
                                            translateNumberToLocale($locale,$book->pivot->quantity,0) }}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">
                                            {{ __('website/home.egp') }}
                                            {{ translateNumberToLocale($locale,$book->getPrice() *
                                            $book->pivot->quantity)}}
                                        </p>
                                    </div>
                                </div>
                                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-2">
                                        <p class="text-muted mb-0 small">{{ __('website/orders.track_order') }}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="progress" style="height: 6px; border-radius: 16px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $order->status_percentage }}%; border-radius: 16px; background-color: #a8729a;"
                                                aria-valuenow="{{ $order->status_percentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-around mb-1">
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{
                                                __('website/orders.cancelled') }}</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{
                                                __('website/orders.pending') }}</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{
                                                __('website/orders.out_for_delivery') }}</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{
                                                __('website/orders.confirmed') }}</p>
                                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{
                                                __('website/orders.delivered') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-between pt-2">
                            <p class="fw-bold mb-0">{{ __('website/orders.order_details') }}</p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">{{ __('website/orders.price')
                                    }}</span> {{ translateNumberToLocale($locale,$order->price_before_discount) }} {{ __('website/home.egp') }}</p>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <p class="text-muted mb-0">{{ __('website/orders.invoice_number') }} : {{ $order->number }}
                            </p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">{{
                                    __('website/orders.delivery_charges') }}</span>   {{ translateNumberToLocale($locale,$order->shipping_fee) }} {{ __('website/home.egp') }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">{{ __('website/orders.invoice_date') }} : {{
                                $order->formatted_created_at }}</p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">{{ __('website/orders.tax_amount')
                                    }}</span>   {{ translateNumberToLocale($locale,$order->tax_amount) }} {{ __('website/home.egp') }}</p>
                        </div>

                        @if ($order->discount)
                        <div class="d-flex justify-content-between mb-5">
                            <p class="text-muted mb-0"></p>
                            <p class="text-muted mb-0"><span class="fw-bold me-4">{{ __('website/orders.discount')
                                    }}</span> %{{ translateNumberToLocale($locale,$order->discount,0) }}</p>
                        </div>
                        @endif

                    </div>
                    <div class="card-footer border-0 px-4 py-5"
                        style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                            {{ __('website/orders.total_paid') }}: <span class="h2 mb-0 ms-2">
                                {{ translateNumberToLocale($locale,$order->total)}}
                                {{ __('website/home.egp') }}
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection