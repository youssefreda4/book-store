<?php

namespace App\Livewire;

use Livewire\Component;

class CartListComponent extends Component
{
    public $books;

    public $cartItems;

    public function render()
    {
        return view('livewire.cart-list-component');
    }
}
