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
        $this->updateAddToCardQuantity(Auth::guard('web')->id(), $this->book->id, $this->quantity);
    }

    public function decrement()
    {
        if (!$this->quantity >= 1) {
            $this->quantity--;
            $this->updateAddToCardQuantity(Auth::guard('web')->id(), $this->book->id, $this->quantity);
        }
    }

    public function removeBook()
    {
        $user_id = Auth::guard('web')->id();
        $book_id = $this->book->id;
        if ($user_id) {
            AddToCart::where('user_id', $user_id)->where('book_id', $book_id)->delete();
        } else {
            $cart = Session::get('cart', []);
            unset($cart[$book_id]);
            Session::put('cart', $cart);
        }

        session()->flash('success', 'Book deleted from cart.');
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

    #[Computed]
    public function updateTotalPrice()
    {
        return $this->total_price = $this->quantity * $this->book->price;
    }

    public function render()
    {
        return view('livewire.cart-item-component');
    }
}
