<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AddToCart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        $user_id = Auth::guard('web')->id();
        if (Auth::guard('web')->check()) {
            $this->syncCartFromSessionToDatabase();
            $carts = AddToCart::where('user_id', $user_id)->get() ?? null;
            $cartItems = [];
            foreach ($carts as $cart) {
                $cartItems[$cart->book_id] =  $cart->quantity;
            }
        } else {
            $cartItems = Session::get('cart', []);
        }
        $books = Book::whereIn('id', array_keys($cartItems))->get();
        return view('website.pages.cart.index', compact('books', 'cartItems'));
    }

    public function addItem(Book $book, Request $request)
    {
        $quantity = $request->has('quantity') ? $request->has('quantity') : 1;
        $user_id = Auth::guard('web')->id();
        $book_id = $book->id;
        //if user is authenticated 
        if (Auth::guard('web')->check()) {
            //if yes store item in database
            AddToCart::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id], [
                'quantity' => $quantity,
            ]);
        } else {
            //else store item in session
            $cart = Session::get('cart', []);
            $cart[$book->id] = $quantity;
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Book added to cart');
    }

    public function updateItem(Request $request, Book $book)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $quantity = $validated['quantity'];
        $user_id = Auth::guard('web')->id();
        $book_id = $book->id;

        if (Auth::guard('web')->check()) {
            AddToCart::where('user_id', $user_id)
                ->where('book_id', $book_id)
                ->update(['quantity' => $quantity]);
        } else {
            //else store item in session
            $cart = Session::get('cart', []);
            $cart[$book_id] = $quantity;
            Session::put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity updated successfully',
            'quantity' => $quantity,
        ]);
    }

    public function removeItem(Book $book)
    {
        $user_id = Auth::guard('web')->id();
        $book_id = $book->id;
        //if user is authenticated 
        if (Auth::guard('web')->check()) {
            //if yes delete item in database
            AddToCart::where('user_id', $user_id)->where('book_id', $book_id)->delete();
        } else {
            //else deleted item in session
            $cart = Session::get('cart', []);
            unset($cart[$book_id]);
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Book deleted from cart');
    }


    public function syncCartFromSessionToDatabase()
    {
        $user_id = Auth::guard('web')->id();
        $cartItems = Session::get('cart', []);

        if (!empty($cartItems)) {
            foreach ($cartItems as $bookId => $quantity) {
                AddToCart::updateOrCreate(
                    ['user_id' => $user_id, 'book_id' => $bookId],
                    ['quantity' => $quantity]
                );
            }
            Session::forget('cart');
        }
    }
}
