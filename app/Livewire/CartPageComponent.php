<?php

namespace App\Livewire;

use App\Models\ShippingArea;
use Livewire\Component;

class CartPageComponent extends Component
{
    public $books;
    public $cartItems;
    public $shipping_areas;
    public $total;

    public function mount()
    {
        $this->shipping_areas = ShippingArea::select('id', 'name', 'fee')->get();
        $this->total = 0;
    }

    public function render()
    {
        return view('livewire.cart-page-component');
    }
}
