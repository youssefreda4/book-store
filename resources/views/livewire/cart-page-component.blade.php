<main>
    @livewire('cart-list-component',['books'=> $books,'cartItems'=> $cartItems],key($books->count()))
    @unless (empty($books) || empty($cartItems) || $total <= 0) 
        @livewire('cart-summary-component', ['total'=> $total,
            'shipping_areas' => $shipping_areas],key(now()->timestamp))
    @endunless
</main>