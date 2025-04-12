<?php

namespace App\Livewire;

use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCartComponent extends Component
{
    public $bookId;
    public $bookQuantity;

    #[On('addToCart')]
    public function addToCart($id)
    {
        $quantity = 1;
        $user_id = Auth::guard('web')->id();
        $book_id = $id;
        //if user is authenticated 
        if (Auth::guard('web')->check()) {
            //if yes store item in database
            AddToCart::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id], [
                'quantity' => $quantity,
            ]);
        } else {
            //else store item in session
            $cart = Session::get('cart', []);
            $cart[$book_id] = $quantity;
            Session::put('cart', $cart);
        }
        // session()->flash('success', 'Book added to cart');
        $this->dispatch('successAlert',[
            'message' => 'Book added to cart',
        ]);

    }

    public function render()
    {
        return view('livewire.add-to-cart-component');
    }
}
