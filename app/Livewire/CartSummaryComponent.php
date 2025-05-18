<?php

namespace App\Livewire;

use App\Enum\PaymentTypeEnum;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CartSummaryComponent extends Component
{
    #[Reactive]
    public $total;

    public $total_with_tax;

    public $shipping_areas;

    public $shipping_fee = 0;

    public $can_checkout = false;

    public $tax_percentage = 15;

    public $tax_amount;

    public $user_addresses = [];

    public $address = '';

    public $cash = PaymentTypeEnum::Cash;

    public $visa = PaymentTypeEnum::Visa;

    public function mount()
    {
        if (Auth::check()) {
            $this->user_addresses = UserAddress::where('user_id', Auth::id())->get();
        }
        $this->calculateTax();
        $this->calculateTotal();
    }

    public function updateShippingArea($shipping_area_id)
    {
        $this->shipping_fee = $this->shipping_areas->where('id', $shipping_area_id)->first()->fee;
        $this->calculateTax();
        $this->calculateTotal();
    }

    public function selectAddress($address)
    {
        $this->address = $address;
    }

    public function calculateTax()
    {
        $this->tax_amount = ($this->total + $this->shipping_fee) * ($this->tax_percentage / 100);
    }

    public function calculateTotal()
    {
        $this->total_with_tax = $this->total + $this->tax_amount + $this->shipping_fee;
    }

    public function render()
    {
        return view('livewire.cart-summary-component');
    }
}
