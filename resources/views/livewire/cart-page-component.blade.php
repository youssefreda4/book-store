<main>
    @livewire('cart-list-component',['books'=> $books,'cartItems'=> $cartItems])
    @unless (empty($books) || empty($cartItems))
        @livewire('cart-summary-component',['total' => $total,'shipping_areas' => $shipping_areas])
    @endunless
</main>