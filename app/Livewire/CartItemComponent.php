<?php

namespace App\Livewire;

use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CartItemComponent extends Component
{
    public $book;

    public $quantity;

    public $total_price;

    public function increment()
    {
        $this->quantity++;
        // $this->updateAddToCardQuantity(Auth::guard('web')->id(), $this->book->id, $this->quantity);
        $this->dispatch('update-quantity', $this->book->id, $this->quantity)->to('cart-page-component');
    }

    public function decrement()
    {
        if ($this->quantity <= 1) {
            return;
        }
        $this->quantity--;
        // $this->updateAddToCardQuantity(Auth::guard('web')->id(), $this->book->id, $this->quantity);
        $this->dispatch('update-quantity', $this->book->id, $this->quantity)->to('cart-page-component');
    }

    public function updateAddToCardQuantity($user_id, $book_id, $quantity)
    {
        if ($user_id) {
            AddToCart::where('user_id', $user_id)
                ->where('book_id', $book_id)
                ->update(['quantity' => $quantity]);
        } else {
            $cart = Session::get('cart', []);
            $cart[$book_id] = $quantity;
            Session::put('cart', $cart);
        }
    }

    public function removeItem()
    {
        $this->dispatch('remove-book',
            book_id: $this->book->id
        )->to(CartPageComponent::class);
    }

    #[Computed]
    public function updateTotalPrice()
    {
        $discount = $this->book->getValidDiscount();
        $bookPrice = $discount
            ? $this->book->price - ($this->book->price * $discount->percentage / 100)
            : $this->book->price;

        return $this->total_price = $this->quantity * $bookPrice;
    }

    public function render()
    {
        return view('livewire.cart-item-component');
    }
}
