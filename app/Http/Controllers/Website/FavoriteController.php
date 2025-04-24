<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AddToFavorite;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('web')->id();
        if (Auth::guard('web')->check()) {
            $this->syncCartFromSessionToDatabase();
            $favorites = AddToFavorite::where('user_id', $user_id)->get() ?? null;
            $favoriteItems = [];
            foreach ($favorites as $favorite) {
                $favoriteItems[$favorite->book_id] =  $favorite->book_id;
            }
        } else {
            $favoriteItems = Session::get('favorite', []);
        }
        $books = Book::whereIn('id', array_values($favoriteItems))->get();
        return view('website.pages.favorite.index', compact('books'));
    }

    public function favoriteActionButton(Book $book, Request $request)
    {
        $user_id = Auth::guard('web')->id();
        $book_id = $book->id;

        if (Auth::guard('web')->check()) {
            if ($book->favorite()->where('user_id', $user_id)->exists()) {
                AddToFavorite::where('user_id', $user_id)->where('book_id', $book_id)->delete();
                return redirect()->back()->with('success', 'Book removed from favorite');
            } else {
                AddToFavorite::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id]);
            }
        } else {
            $favorite = Session::get('favorite', []);
            if (session('favorite') && array_key_exists($book_id, session('favorite'))) {
                unset($favorite[$book_id]);
                Session::put('favorite', $favorite);
                return redirect()->back()->with('success', 'Book removed from favorite');
            } else {
                $favorite[$book_id] = $book_id;
                Session::put('favorite', $favorite);
            }
        }
        return redirect()->back()->with('success', 'Book added to favorite');
    }

    public function removeItem(Book $book)
    {
        //
    }

    public function syncCartFromSessionToDatabase()
    {
        $user_id = Auth::guard('web')->id();
        $favoriteItems = Session::get('favorite', []);

        if (!empty($favoriteItems)) {
            foreach ($favoriteItems as $bookId) {
                AddToFavorite::updateOrCreate(
                    ['user_id' => $user_id, 'book_id' => $bookId],
                );
            }
            Session::forget('favorite');
        }
    }
}
