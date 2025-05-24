@extends('website.layouts.main')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', __('website/books.library'))

@section('content')
    <section class="library my-5">
        <div class="container">
            <livewire:book-filter />
        </div>
    </section>
@endsection

@push('js')
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('front-assets') }}/js/books.js"></script>
    <!-- End Swiper -->
@endpush