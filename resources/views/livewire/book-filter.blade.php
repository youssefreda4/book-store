<div class="row">
    @php
    $locale = app()->getLocale();
    @endphp
    <div class="col-12 col-lg-3">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ __('website/books.categories') }}
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 align-items-center">
                                <input type="checkbox" name="categories" id="categories" />
                                <label for="categories">{{ __('website/books.all_categories') }}</label>
                            </div>
                            <p>({{ $this->categories->count() }})</p>
                        </div>
                        @foreach ($this->categories as $category)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 align-items-center">
                                <input type="checkbox" value="{{ $category->id }}" wire:model.live="categories_id" />
                                <label for="business">{{$category->name}}</label>
                            </div>
                            <p>({{$category->books_count}})</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item my-3">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {{ __('website/books.publisher') }}
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex flex-column gap-3">
                        @foreach ($this->publishers as $publisher)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 align-items-center">
                                <input type="checkbox" value="{{ $publisher->id }}" wire:model.live="publishers_id" />
                                <label for="business">{{$publisher->name}}</label>
                            </div>
                            <p>({{$publisher->books_count}})</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        {{ __('website/books.year') }}
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for="startYear" class="form-label">{{ __('website/books.start_year') }}</label>
                            <input type="number" class="form-control" id="startYear" wire:model.blur="start_year"
                                placeholder="e.g. 2015">
                        </div>
                        <div class="mb-3">
                            <label for="endYear" class="form-label">{{ __('website/books.end_year') }}</label>
                            <input type="number" class="form-control" id="endYear" wire:model.blur="end_year"
                                placeholder="e.g. 2025">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-9">
        <div class="swiper">
            <div class="swiper-wrapper">
                {{-- <div class="swiper-slide swiper-slide_category active">
                    Business
                </div> --}}
                @foreach ($this->categories as $category)
                <div class="swiper-slide swiper-slide_category ">{{$category->name}}</div>
                @endforeach
            </div>
        </div>
        @foreach ($books as $book)
        <div class="row books_book">
            <div class="col-lg-3">
                <a href="{{ route('front.books.show',$book->slug) }}">
                    <div class="book_image">
                        @if (empty($book->getFirstMediaUrl('book', 'preview')))
                        <img src="https://dummyimage.com/512x768/000/fff" alt="" class="w-100 h-100" />
                        @else
                        <img src="{{  $book->getFirstMediaUrl('book', 'preview') }}" alt="" class="w-100 h-100" />
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-9">
                <div class="book_detailes">
                    <div class="d-flex align-items-start book_detailes__content">
                        <div>
                            <p class="book_detailes__title">{{ $book->name }}</p>
                            <p class="book_detailes__description">
                                {{ Str::limit($book->description, 70, '...') }}
                            </p>
                        </div>
                        @php
                        $discount = $book->getValidDiscount();
                        @endphp
                        @if ($discount)
                        <div class="discount">
                            <p class="discount_code">{{ $discount->percentage }}%
                                @if ($discount->code)
                                {{ __('website/books.discount_code') }}: {{ $discount->code }}
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end gap-4">
                        <div>
                            <div class="book_stars">
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
                                </div>
                            </div>
                            <div class="d-flex gap-5">
                                <div>
                                    <p class="author">{{ __('website/books.author') }}</p>
                                    <p class="author_name">{{ $book->author->name }}</p>
                                </div>
                                <div>
                                    <p class="author">{{ __('website/books.publisher_name') }}</p>
                                    <p class="author_name">{{ $book->publisher->name }}</p>
                                </div>
                                <div>
                                    <p class="year">{{ __('website/books.year_published') }}</p>
                                    <p>{{ $book->publish_year }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="recommended_card__price">
                                @if ($discount)
                                <div class="d-flex align-items-center justify-content-start gap-2 mb-2">
                                    <span class="text-muted text-decoration-line-through small">
                                        {{ __('website/home.egp') }}
                                        {{ translateNumberToLocale($locale, $book->price) }}
                                    </span>

                                    <span class="badge bg-warning text-dark fw-semibold px-2">
                                        -{{ $discount->percentage }}%
                                    </span>
                                </div>

                                <p class="text-dark fw-bold fs-5 mb-4">
                                    {{ __('website/home.egp') }}
                                    {{ translateNumberToLocale($locale, $book->getPrice()) }}
                                </p>
                                @else
                                <p class="text-dark fw-bold fs-5 mb-4">
                                    {{ __('website/home.egp') }}
                                    {{ translateNumberToLocale($locale, $book->price) }}
                                </p>
                                @endif

                                <div class="d-flex flex-wrap gap-5 mt-auto justify-content-end">

                                    {{-- Cart --}}
                                    @if ($book->quantity)
                                        @if ( session()->get('cart')[$book->id] ?? false || $book->cartForCurrentUser)
                                            <span class="text-center main_btn light cart-btn w-50">
                                               {{ __('website/books.added_to_cart') }}
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </span>
                                        @else
                                            <form action="{{ route('front.cart.add',$book) }}" method="POST">
                                                @csrf
                                                <button class="text-center main_btn cart-btn w-100  flex-grow-1">
                                                    <span>{{ __('website/books.add_to_cart') }}</span>
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-center main_btn light cart-btn w-50">{{ __('website/books.not_available') }}</span>
                                    @endif

                                    {{-- Favorite --}}
                                    @php
                                        $isInSessionFavorite = session('favorite') && array_key_exists($book->id,
                                        session('favorite'));
                                        $isInDbFavorite = auth('web')->check() &&
                                        $book->favorite->where('user_id',auth('web')->id())->isNotEmpty();
                                    @endphp
                                    <form action="{{ route('front.favorite.action',$book) }}" method="POST">
                                        @csrf
                                        <button class="primary_btn">
                                            @if ($isInSessionFavorite || $isInDbFavorite)
                                             <i class="fa-solid fa-heart-circle-minus"></i>
                                            @else
                                             <i class="fa-regular fa-heart"></i>
                                            @endif
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
    {{$books->links('pagination::bootstrap-5')}}
</div>

@push('js')
<script>
    document.querySelectorAll('.recommended_card__rate').forEach(rateDiv => {
        const rate = parseFloat(rateDiv.getAttribute('data-rate')) || 0;
        const stars = rateDiv.querySelectorAll('.stars-container i');
        const rateValueEl = rateDiv.querySelector('.rate-value');

        if (rateValueEl) {
        rateValueEl.textContent = rate.toFixed(2);
        }

        stars.forEach((star, index) => {
        const starNumber = index + 1;

        if (rate >= starNumber) {
            star.classList.add('text-warning');
            star.classList.remove('text-secondary');
            star.classList.replace('fa-star-half-alt', 'fa-star');
        } else if (rate + 0.5 >= starNumber) {
            star.classList.add('text-warning');
            star.classList.remove('text-secondary');
            star.classList.replace('fa-star', 'fa-star-half-alt');
        } else {
            star.classList.add('text-secondary');
            star.classList.remove('text-warning', 'fa-star-half-alt');
            star.classList.replace('fa-star-half-alt', 'fa-star');
        }
        });
    });
</script>
@endpush