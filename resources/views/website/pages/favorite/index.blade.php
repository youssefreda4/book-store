@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/wishlist.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('title', 'Favorite')

@section('content')

@if($books->isNotEmpty())
@dump($favoriteItems)
<section class="my-5">
    <div class="container">
        <div class="row py-4 table_head">
            <div class="col-5">
                <p>Item</p>
            </div>
            <div class="col-2">
                <p>Quantity</p>
            </div>
            <div class="col-2">
                <p>Price</p>
            </div>
            <div class="col-3">
                <p>Total Price</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @foreach ($books as $book)
                <div class="item-cart row mb-4">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="item-image">
                            <img src="{{ $book->getFirstMediaUrl('book', 'preview') ?: 'https://dummyimage.com/512x768/000/fff' }}"
                                alt="" class="w-100 h-100" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="item-description d-flex flex-column gap-2">
                            <p class="fw-bold">{{ $book->name }}</p>
                            <p class="description">
                                Author:
                                <span class="fw-bold text-dark">{{ $book->author->name }}</span>
                            </p>
                            <p class="description book-description">
                                {{ $book->description }}
                            </p>
                            <div class="dlivery d-flex gap-3">
                                <img src="{{ asset('front-assets') }}/images/shipping.png" alt="" width="20"
                                    height="20" />
                                <p class="description">Free Shipping Today</p>
                            </div>
                            @php
                            $discount = $book->getValidDiscount();
                            @endphp
                            @if ($discount)
                            <div class="mt-3">
                                <span class="text-danger">{{ $discount->percentage }}%</span>
                            </div>
                            <p class="description">
                                @if ($discount->code)
                                <span class="sell-code description fw-bold fs-5"> Discount code :</span> {{
                                $discount->code}}
                                @endif
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
                        <div class="d-flex gap-3 align-items-center mt-3">
                            <div class="books_count d-flex gap-3 align-items-center">
                                <span class="decrement">-</span>
                                <p class="quantity">{{ $favoriteItems[$book->id] }}</p>
                                <input type="hidden" value="{{ $book->slug }}" id="book"></input>
                                <span class="increment">+</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
                        <p class="fw-bold fs-5 mt-3 book-price">${{ $book->price }}</p>
                    </div>
                    <div class="sell-price col-lg-2 col-md-4 col-sm-4 d-flex align-items-center">
                        <p class="fw-bold fs-5 mt-3 total-price">${{ $book->price }}</p>
                    </div>
                    <div class="col-lg-1 col-md-4 col-sm-4 d-flex align-items-center">
                        <form action="{{ route('front.favorite.action', $book) }}" method="POST" class="mt-3">
                            @csrf
                            <button class="fs-5 del-item border-0 bg-transparent text-danger">
                                <i class="fa-solid fa-trash-can main_text"></i>
                                <p class="remove">Remove</p>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap ">
                {{-- @dd($books) --}}
                <form action="{{ route('front.favorite.move') }}" method="POST" class="w-50">
                    @csrf
                    @foreach ($books as $book)
                        <input type="hidden" name="books[]" value="{{ $book->slug }}">
                    @endforeach
                    <button
                        class="main_btn d-flex  justify-content-between align-items-center col-12 col-md-5 col-lg-4 w-100">
                        <div>
                            <div class="checkout-btn">
                                <p>{{ $books->count() }} Item</p>
                                <p class="subtotal-amount"></p>
                            </div>
                        </div>
                        <div>
                            <p class="fs-6 fw-bold"> Move to cart</p>
                        </div>
                        <div class="arrow-icon">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </button>
                </form>
            </div>
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

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateCartTotal(){
        let subtotal = 0;

        document.querySelectorAll('.item-cart').forEach(cartItem => {
            const totalPrice = cartItem.querySelector('.total-price');
            const priceValue = parseFloat(totalPrice.textContent.replace('$', '')) || 0;
            subtotal += priceValue;
        });

        const subtotalAmount= document.querySelector('.subtotal-amount');
        
        if (subtotalAmount) subtotalAmount.textContent = `$${(subtotal || 0).toFixed(2)}`;
    }
    
    document.querySelectorAll('.item-cart').forEach(cartItem => {
        const decrement = cartItem.querySelector('.decrement');
        const increment = cartItem.querySelector('.increment');
        const valueOfQuantity = cartItem.querySelector('.quantity');
        const bookPrice = cartItem.querySelector('.book-price');
        const totalPrice = cartItem.querySelector('.total-price');

        let quantity = parseInt(valueOfQuantity.textContent);
        const bookPriceValue = parseFloat(bookPrice.textContent.replace('$', ''));

        function calcTotalPrice() {
            const finalPrice = quantity * bookPriceValue;
            totalPrice.textContent = `$${finalPrice.toFixed(2)}`;
            updateCartTotal()
        }

        
        increment.addEventListener('click', () => {
            const bookSlug = cartItem.querySelector('#book').value;
            const updateCartUrl =  `/favorite/item/${bookSlug}`
            quantity++;
            valueOfQuantity.textContent = quantity;
            calcTotalPrice();
            
            $.ajax({
                url: updateCartUrl,
                method: 'PUT',
                data: {
                        quantity: quantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            valueOfQuantity.textContent = response.quantity;
                            console.log('Quantity updated successfully');
                        } else {
                            console.error('Update failed:', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ajax error:', error);
                    }
            });
        });

        decrement.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                valueOfQuantity.textContent = quantity;
                calcTotalPrice();

                $.ajax({
                    url: updateCartUrl,
                    method: 'PUT',
                    data: {
                        quantity: quantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            valueOfQuantity.textContent = response.quantity;
                            console.log('Quantity updated successfully');
                        } else {
                            console.error('Update failed:', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ajax error:', error);
                    }
                });
            }
        });

        calcTotalPrice();
    });

    updateCartTotal()
</script>

@endpush