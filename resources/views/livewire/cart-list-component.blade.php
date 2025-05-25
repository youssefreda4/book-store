<section class="my-5">
    <div class="container">
        <div class="row py-4 table_head">
            <div class="col-5">
                <p>{{__('website/cart-list.item')}}</p>
            </div>
            <div class="col-2">
                <p>{{__('website/cart-list.quantity')}}</p>
            </div>
            <div class="col-2">
                <p>{{__('website/cart-list.price')}}</p>
            </div>
            <div class="col-3">
                <p>{{__('website/cart-list.total_price')}}</p>
            </div>
        </div>

        <div class="col-12">
            @forelse  ($books as $book)
                @livewire('cart-item-component',['book' => $book,'quantity' => $cartItems[$book->id]],key($book->id))
            @empty
                <section class="my-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
                    <div class="container">
                        <div class="col-12">
                            <h1 class="text-center text-danger fw-bold display-4">
                               {{__('website/cart-list.no_books')}}
                            </h1>
                        </div>
                    </div>
                </section>
            @endforelse
        </div>

    </div>
</section>