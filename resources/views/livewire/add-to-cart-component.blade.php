<div class="d-flex flex-wrap gap-5 mt-auto justify-content-end">
    @if ($bookQuantity)
        @if ( session()->get('cart')[$bookId] ?? null)
            <span class="text-center main_btn light cart-btn w-50">
                Added To Cart
                <i class="fa-solid fa-cart-shopping"></i>
            </span>
        @else
            <button class="text-center main_btn cart-btn w-100  flex-grow-1"
                wire:click="$dispatch('addToCart',{ id: {{ $bookId }} })">
                <span>Add To Cart</span>
                <i class="fa-solid fa-cart-shopping"></i>
            </button>
        @endif
    @else
        <span class="text-center main_btn light cart-btn w-50">Not Available</span>
    @endif

    <button class="primary_btn">
        <i class="fa-regular fa-heart"></i>
    </button>
</div>