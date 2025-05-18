<?php

namespace App\Livewire;

use App\Models\AddToCart;
use App\Models\Book;
use App\Models\ShippingArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class CartPageComponent extends Component
{
    public $books;

    public $cartItems;

    public $shipping_areas;

    public $total;

    protected $listeners = [
        'remove-book' => 'handleRemoveItem',
        'update-quantity' => 'handleUpdateQuantity',
    ];

    public function mount()
    {
        $this->shipping_areas = ShippingArea::select('id', 'name', 'fee')->get();
        $this->loadCartItems();
        $this->calculateTotal();
    }

    public function handleRemoveItem($book_id)
    {
        $this->removeBookFromCart($book_id);
        $this->removeBookFromList($book_id);
        $this->calculateTotal();
    }

    public function handleUpdateQuantity($book_id, $quantity)
    {
        $user_id = Auth::guard('web')->id();
        if ($user_id) {
            AddToCart::where('user_id', $user_id)
                ->where('book_id', $book_id)
                ->update(['quantity' => $quantity]);
        } else {
            $cart = Session::get('cart', []);
            $cart[$book_id] = $quantity;
            Session::put('cart', $cart);
        }
        $this->loadCartItems();
        $this->calculateTotal();
    }

    public function removeBookFromCart($book_id)
    {
        $user_id = Auth::guard('web')->id();
        if ($user_id) {
            AddToCart::where('user_id', $user_id)->where('book_id', $book_id)->delete();
        } else {
            $cart = Session::get('cart', []);
            unset($cart[$book_id]);
            Session::put('cart', $cart);
        }
    }

    public function loadCartItems()
    {
        $user_id = Auth::guard('web')->id();
        if ($user_id) {
            $this->cartItems = AddToCart::where('user_id', $user_id)->pluck('quantity', 'book_id')->toArray();
            $this->books = Book::whereIn('id', array_keys($this->cartItems))->get();
        } else {
            $this->cartItems = Session::get('cart', []);
            $this->books = Book::whereIn('id', array_keys($this->cartItems))->get();
        }
    }


    public function removeBookFromList($book_id)
    {
        $this->books = $this->books->reject(fn($b) => $b->id == $book_id);
    }

    public function calculateTotal()
    {
        $this->total = 0;
        $this->books->each(function ($book) {
            $bookPrice = $this->getPriceWithDiscount($book);
            $quantity = $this->cartItems[$book->id] ?? 1;
            $this->total += ($bookPrice * $quantity);
        });
    }

    public function getPriceWithDiscount($book)
    {
        $discount = $book->getValidDiscount();
        $bookPrice = $discount
            ? $book->price - ($book->price * $discount->percentage / 100)
            : $book->price;

        return $bookPrice;
    }

    public function render()
    {
        return view('livewire.cart-page-component');
    }
}
