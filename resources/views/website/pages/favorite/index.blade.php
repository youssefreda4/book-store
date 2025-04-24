@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/cart.css" />
@endpush
@section('title', 'Favorite')

@section('content')

@if($books->isNotEmpty())
<section class="my-5">
    <div class="container">
        <div class="col-12">
            @foreach ($books as $book)
            <div class="item-cart row">
                <div class="col-lg-2 col-md-4 col-sm-6">
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
                            {{-- Info Section --}}
                            <div>
                                <div class="book_stars">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div>
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa-solid fa-star text-warning"></i>
                                            @endfor
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
                                        <p class="year">Year</p>
                                        <p>{{ $book->publish_year }}</p>
                                    </div>
                                </div>
                            </div>
                        
                            {{-- Actions Section --}}
                            <div class="flex-grow-1">
                                <div class="recommended_card__price">
                                    <p class="text-end mb-4">$ {{ $book->price }}</p>
                                    <div class="d-flex flex-wrap gap-3 justify-content-end align-items-center">
                        
                                        {{-- Cart Handling --}}
                                        @if ($book->quantity)
                                            @if (session('cart')[$book->id] ?? false || $book->addToCart()->where('user_id', auth('web')->id())->exists())
                                                <span class="main_btn light cart-btn w-auto px-2 d-flex align-items-center gap-2">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    Added to Cart
                                                </span>
                                            @else
                                                <form action="{{ route('front.cart.add', $book) }}" method="POST">
                                                    @csrf
                                                    <button class="main_btn cart-btn w-auto px-3 d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="main_btn light cart-btn w-auto px-3">Not Available</span>
                                        @endif
                        
                                        {{-- Remove from Favorite --}}
                                        <form action="{{ route('front.favorite.action', $book) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-lg gap-2">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@else

<section class="my-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="container">
        <div class="col-12">
            <h1 class="text-center text-danger fw-bold display-4">
                No Book Added Yet!
            </h1>
        </div>
    </div>
</section>

@endif
@endsection