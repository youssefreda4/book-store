<main>
    @livewire('cart-list-component',['books'=> $books,'cartItems'=> $cartItems],key($books->count()))
    @unless (empty($books) || empty($cartItems))
        @livewire('cart-summary-component',['total' => $total,'shipping_areas' => $shipping_areas],key('cart-summary-'.$total))
    @endunless
</main>