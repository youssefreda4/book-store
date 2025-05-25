<div class="item-cart row">
    @php
    $locale = app()->getLocale();
    @endphp
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="item-image">
            @if (empty($book->getFirstMediaUrl('book', 'preview')))
            <img src="https://dummyimage.com/512x768/000/fff" alt="" class="w-100 h-100" />
            @else
            <img src="{{  $book->getFirstMediaUrl('book', 'preview') }}" alt="" class="w-100 h-100" />
            @endif
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="item-description d-flex flex-column gap-2">
            <p class="fw-bold">{{ $book->name }}</p>
            <p class="description">
                {{__('website/cart-item.author')}}
                <span class="fw-bold text-dark">{{ $book->author->name }}</span>
            </p>
            <p class="description book-description">
                {{$book->description}}
            </p>
            {{-- <div class="dlivery d-flex gap-3">
                <img src="{{ asset('front-assets') }}/images/shipping.png" alt="" width="20" height="20" />
                <p class="description">Free Shipping Today</p>
            </div> --}}
            @php
            $discount = $book->getValidDiscount();
            @endphp
            @if ($discount)
            <div class="mt-3">
                <span class="text-danger">{{ $discount->percentage }}%</span>

            </div>
            <p class="description">
                @if ($discount->code)
                <span class="sell-code description fw-bold fs-5">{{__('website/cart-item.discount_code')}}</span> {{
                $discount->code}}
                @endif

            </p>
            @endif
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
        <div class="d-flex gap-3 align-items-center mt-3">
            <div class="books_count d-flex gap-3 align-items-center">
                <span class="decrement" wire:click='decrement'>-</span>
                <p class="quantity" wire:loading.remove>{{ translateNumberToLocale($locale,$quantity) }}</p>

                <div class="spinner-grow spinner-grow-sm text-danger" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>

                <span class="increment" wire:click='increment'>+</span>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
        <p class="fw-bold fs-5 mt-3 book-price">
            {{ __('website/home.egp') }}
            {{ translateNumberToLocale($locale, $book->getPrice()) }}
    </div>
    <div class="sell-price col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
        <p class="fw-bold fs-5 mt-3 total-price">
            {{ __('website/home.egp') }}
            {{ translateNumberToLocale($locale,$this->updateTotalPrice) }}
        </p>
    </div>
    <div class="col-lg-1 col-md-4 col-sm-4 d-flex align-items-center">
        <div class="fs-5 mt-3 del-item" wire:click="removeItem">
            <button class="fs-5 mt-3 btn btn-danger">
                <i class="fa-solid fa-trash-can  "></i>
            </button>
        </div>
    </div>
</div>