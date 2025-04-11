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
        if (Auth::check()) {
            $cart = AddToCart::where('user_id', $user_id)->get();
        } else {
            $cart = Session::get('cart', []);
        }
        $books = Book::whereIn('id', array_keys($cart))->get();
        return view('website.pages.cart.index', compact('books'));
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
}
