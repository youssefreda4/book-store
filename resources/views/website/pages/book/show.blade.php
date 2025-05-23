@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/books.css" />
@endpush
@section('title', 'Book')

@section('content')
<section class="library my-5">
    <div class="container">
        <div class="row books_book">
            <div class="col-lg-3">
                <div class="book_image">
                    @if (empty($book->getFirstMediaUrl('book', 'preview')))
                    <img src="https://dummyimage.com/512x768/000/fff" alt="" class="w-100 h-100" />
                    @else
                    <img src="{{  $book->getFirstMediaUrl('book', 'preview') }}" alt="" class="w-100 h-100" />
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="book_detailes">
                    <div class="d-flex align-items-start book_detailes__content">
                        <div>
                            <p class="book_detailes__title">{{ $book->name }}</p>
                            <p class="book_detailes__description">
                                {{$book->description}}
                            </p>
                        </div>
                        @php
                        $discount = $book->getValidDiscount();
                        @endphp
                        @if ($discount)
                        <div class="discount">
                            <p class="discount_code">{{ $discount->percentage }}%
                                @if ($discount->code)
                                Discount code: {{ $discount->code }}
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end gap-4">
                        <div>
                            <div class="book_stars">
                                <div class="d-flex gap-2 align-items-center">
                                    <div>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </div>
                                    <p class="book_stars__review">(210 Review)</p>
                                </div>
                                <p class="my-3 book_stars__review-rate">
                                    Rate: <span class="text-dark">{{ $book->rate }}</span>
                                </p>
                            </div>
                            <div class="d-flex gap-5">
                                <div>
                                    <p class="author">Author</p>
                                    <p class="author_name">{{ $book->author->name }}</p>
                                </div>
                                <div>
                                    <p class="author">Publisher</p>
                                    <p class="author_name">{{ $book->publisher->name }}</p>
                                </div>
                                <div>
                                    <p class="year">Year</p>
                                    <p>{{ $book->publish_year }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="recommended_card__price">
                                <p class="text-end mb-4">$ {{ $book->price }}</p>
                                <div class="d-flex flex-wrap gap-5 mt-auto justify-content-end">

                                    {{-- Cart --}}
                                    @if ($book->quantity)
                                    @if ( session()->get('cart')[$book->id] ?? false || $book->cartForCurrentUser)
                                    <span class="text-center main_btn light cart-btn w-50">
                                        Added To Cart
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </span>
                                    @else
                                    <form action="{{ route('front.cart.add',$book) }}" method="POST">
                                        @csrf
                                        <button class="text-center main_btn cart-btn w-100  flex-grow-1">
                                            <span>Add To Cart</span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @else
                                    <span class="text-center main_btn light cart-btn w-50">Not Available</span>
                                    @endif

                                    {{-- Favorite --}}
                                    @php
                                    $isInSessionFavorite = session('favorite') && array_key_exists($book->id,
                                    session('favorite'));
                                    $isInDbFavorite = auth('web')->check() && $book->favorite->isNotEmpty();
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection