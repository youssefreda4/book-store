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

        <div class="col-12">
            @forelse  ($books as $book)
                @livewire('cart-item-component',['book' => $book,'quantity' => $cartItems[$book->id]],key($book->id))
            @empty
                <section class="my-5 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
                    <div class="container">
                        <div class="col-12">
                            <h1 class="text-center text-danger fw-bold display-4">
                                No Book Added Yet!
                            </h1>
                        </div>
                    </div>
                </section>
            @endforelse
        </div>

    </div>
</section>