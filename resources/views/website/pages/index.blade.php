@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/home.css" />
@endpush
@section('title', __('website/home.home'))
@section('hero_content')
@livewire('home-search-component')
@endsection

@section('content')
@php
    $locale = app()->getLocale();
@endphp
<section class="main_bg py-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="feature">
                    <div class="feature_icon">
                        <img src="{{ asset('front-assets') }}/images/shipping.png" alt="" />
                    </div>
                    <div class="feature_title">
                        <h1>{{ __('website/home.fast_and_reliable_shipping') }}</h1>
                    </div>
                    <div class="feature_description">
                        <p>
                            {{__('website/home.description_fast_and_reliable_shipping')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="feature">
                    <div class="feature_icon">
                        <img src="{{ asset('front-assets') }}/images/credit-card-buyer.png" alt="" />
                    </div>
                    <div class="feature_title">
                        <h1>{{ __('website/home.secure_payment') }}</h1>
                    </div>
                    <div class="feature_description">
                        <p>
                            {{__('website/home.description_secure_payment')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="feature">
                    <div class="feature_icon">
                        <img src="{{ asset('front-assets') }}/images/restock.png" alt="" />
                    </div>
                    <div class="feature_title">
                        <h1>{{ __('website/home.easy_returns') }}</h1>
                    </div>
                    <div class="feature_description">
                        <p>
                            {{__('website/home.description_easy_returns')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="feature">
                    <div class="feature_icon">
                        <img src="{{ asset('front-assets') }}/images/user-headset.png" alt="" />
                    </div>
                    <div class="feature_title">
                        <h1> {{ translateNumberToLocale($locale,24,0).'/'.translateNumberToLocale($locale,7,0) . ' ' .
                            __('website/home.customer_support') }}</h1>
                    </div>
                    <div class="feature_description">
                        <p>
                            {{__('website/home.description_customer_support')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($bestSellingBooks)
<section class="best_seller">
    <div class="container">
        <div class="best_seller-head">
            <h2>{{ __('website/home.best_seller') }}</h2>
            <p>
                {{ __('website/home.description_best_seller') }}
            </p>
        </div>
    </div>
    <div id="splide-marquee" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($bestSellingBooks as $book)
                <li class="splide__slide">
                    <a href="{{ route('front.books.show',$book->slug) }}">
                        <img src="{{ $book->getFirstMediaUrl('book', 'preview') }}" alt="" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="shop d-flex justify-content-center">
        <button class="main_btn shop_btn">{{ __('website/home.shop_now') }}</button>
    </div>
</section>
@endif

@if($recommended_books->isNotempty())
<section class="recommended my-5 py-5 border-bottom">
    <div class="container">
        <p class="recommended_title mb-5">{{ __('website/home.recomended_for_you') }}</p>
        <div class="row g-4">
            @foreach ($recommended_books as $book)
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="recommended_card d-flex gap-4 p-4">
                    <a class="recomended_card__image" href="{{ route('front.books.show',$book->slug) }}">
                        <div>
                            <img src="{{ $book->getFirstMediaUrl('book', 'preview') }}" alt="" class="w-100 h-100" />
                        </div>
                    </a>
                    <div class="d-flex flex-column gap-2">
                        <div class="recommended_card__content">
                            <h3>{{ $book->name }}</h3>
                            <p class="recommended_author">
                                <span>{{ __('website/home.author') }}:</span> {{ $book->author->name }}
                            </p>
                            <p class="recommended_description">
                                {{ $book->description }}
                            </p>
                        </div>

                        <div class="recommended_card__rate d-flex flex-wrap justify-content-between align-items-center"
                            data-rate="{{ $book->rate }}">
                            <div>
                                <div class="stars d-flex gap-1">
                                    <div class="stars-container">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <p class="rate text-light">
                                    <span class="text-secondary"> {{ __('website/home.rate') }} : </span> <span
                                        class="rate-value">0</span>
                                </p>
                            </div>
                            <div class="recommended_card__price">
                                <p> {{ __('website/home.egp') }} {{ translateNumberToLocale($locale,$book->price) }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-3 mt-auto">
                            {{-- Cart --}}
                            @if ($book->quantity)
                                @if ( session()->get('cart')[$book->id] ?? false || $book->cartForCurrentUser)
                                <span class="text-center main_btn light cart-btn w-50">
                                    {{ __('website/home.added_to_cart') }}
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </span>
                                @else
                                    <form action="{{ route('front.cart.add',$book) }}" method="POST">
                                        @csrf
                                        <button class="text-center main_btn cart-btn w-100  flex-grow-1">
                                            <span>{{ __('website/home.add_to_cart') }}</span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="text-center main_btn light cart-btn w-50">{{ __('website/home.not_available')}}</span>
                            @endif

                            {{-- Favorite --}}
                            @php
                                $isInSessionFavorite = session('favorite') && array_key_exists($book->id,
                                session('favorite'));
                                $isInDbFavorite = auth('web')->check() && $book->favorite->where('user_id',auth('web')->id())->isNotEmpty();
                            @endphp
                            @if ($isInSessionFavorite || $isInDbFavorite)
                                <form action="{{ route('front.favorite.action',$book) }}" method="POST">
                                    @csrf
                                    <button class="primary_btn">
                                        <i class="fa-solid fa-heart-circle-minus"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('front.favorite.action',$book) }}" method="POST">
                                    @csrf
                                    <button class="primary_btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($books->isNotempty())
<section class="books-sale">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="books-sale_head">
                <h4>{{ __('website/home.flash_sale') }}</h4>
                <p>
                    {{ __('website/home.description_flash_sale') }}
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="splide d-flex p-0" aria-label="Custom Arrows Example" id="saleSlider">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="splide__track w-100 p-0">
                        <ul class="splide__list w-100">
                            @foreach ($books as $book)
                            @php
                                $expiryDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $book->discountable->date
                                . ' ' . $book->discountable->start_time)
                                ->addHours($book->discountable->time)
                                ->format('Y-m-d H:i:s');
                            @endphp

                            <li class="splide__slide splide__slide-sale">
                                <div class="books-sale_card w-100 p-4 position-relative">
                                    <div class="books-sale_card__image w-50">
                                        <img src="{{ $book->getFirstMediaUrl('book', 'preview') }}" alt="book_image" />
                                        <div class="countdown-timer">
                                            <p class="countdown" data-expiry="{{ $expiryDateTime }}"
                                                data-book-id="{{ $book->id }}">
                                                {{ $book->getFlashSaleRemainingTimeFormatted($book->discountable) }}
                                            </p>
                                            <span class="countdown-label">Time Left</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column w-100 gap-2">
                                        <div class="recommended_card__content">
                                            <h3 class="text-light">{{ $book->name }}</h3>
                                            <p class="recommended_author text-light">
                                                <span class="text-secondary">Author:</span> {{ $book->author->name ??
                                                'Unknown' }}
                                            </p>
                                        </div>
                                        <div class="recommended_card__rate d-flex flex-wrap justify-content-between align-items-center"
                                            data-rate="{{ $book->rate }}">
                                            <div>
                                                <div class="stars d-flex gap-1">
                                                    <div class="stars-container">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="rate text-light">
                                                    <span class="text-secondary"> {{ __('website/home.rate') }} :
                                                    </span> <span class="rate-value">0</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <p class="sale_price">{{ __('website/home.egp') }} {{
                                                translateNumberToLocale($locale,$book->getPrice()) }}</p>
                                            <p class="main_price">{{ __('website/home.egp') }} {{
                                                translateNumberToLocale($locale,$book->price) }}</p>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-end mt-auto">
                                            @if ($book->quantity)
                                                @if ( session()->get('cart')[$book->id] ?? false || $book->cartForCurrentUser)
                                                <span class="text-center main_btn light cart-btn w-50">
                                                    {{ __('website/home.added_to_cart') }}
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </span>
                                                @else
                                                    <form action="{{ route('front.cart.add',$book) }}" method="POST">
                                                        @csrf
                                                        <button class="text-center main_btn cart-btn w-100  flex-grow-1">
                                                            <i class="fa-solid fa-cart-shopping"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <span class="text-center main_btn light cart-btn w-50">{{ __('website/home.not_available')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="{{ asset('front-assets') }}/js/home.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
  const countdownElements = document.querySelectorAll('.countdown');

  countdownElements.forEach(el => {
    const expiryStr = el.getAttribute('data-expiry');
    const expiryTime = new Date(expiryStr).getTime();

    function updateTimer() {
      const now = new Date().getTime();
      let diff = Math.floor((expiryTime - now) / 1000);

      if (diff <= 0) {
        el.textContent = '00:00:00';
        clearInterval(interval);
        return;
      }

      const hrs = Math.floor(diff / 3600);
      const mins = Math.floor((diff % 3600) / 60);
      const secs = diff % 60;

      el.textContent = [hrs, mins, secs].map(n => n.toString().padStart(2, '0')).join(':');
    }

    updateTimer();
    const interval = setInterval(updateTimer, 1000);
  });
});
</script>


@endpush