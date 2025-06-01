<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AddToCart;
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
            $this->syncFavoriteFromSessionToDatabase();
            $favorites = AddToFavorite::where('user_id', $user_id)->get() ?? null;
            $favoriteItems = $favorites->mapWithKeys(fn ($item) => [$item->book_id => $item->quantity])->toArray();
        } else {
            $favoriteItems = Session::get('favorite', []);
        }
        $books = Book::whereIn('id', array_keys($favoriteItems))->get();

        return view('website.pages.favorite.index', compact('books', 'favoriteItems'));
    }

    public function favoriteActionButton(Book $book, Request $request)
    {
        $quantity = 1;
        $user_id = Auth::guard('web')->id();
        $book_id = $book->id;

        if (Auth::guard('web')->check()) {
            if ($book->favorite()->where('user_id', $user_id)->exists()) {
                AddToFavorite::where('user_id', $user_id)->where('book_id', $book_id)->delete();

                return redirect()->back()->with('success', __('website/favorite.book_removed_from_favorite'));
            } else {
                AddToFavorite::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id], ['quantity' => $quantity]);
            }
        } else {
            $favorite = Session::get('favorite', []);
            if (session('favorite') && array_key_exists($book_id, session('favorite'))) {
                unset($favorite[$book_id]);
                Session::put('favorite', $favorite);

                return redirect()->back()->with('success',  __('website/favorite.book_removed_from_favorite'));
            } else {
                $favorite[$book_id] = $quantity;
                Session::put('favorite', $favorite);
            }
        }

        return redirect()->back()->with('success',  __('website/favorite.book_added_to_favorite'));
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
            AddToFavorite::where('user_id', $user_id)
                ->where('book_id', $book_id)
                ->update(['quantity' => $quantity]);
        } else {
            // else store item in session
            $favorite = Session::get('favorite', []);
            if (array_key_exists($book_id, $favorite)) {
                $favorite[$book_id] = $quantity;
            }
            Session::put('favorite', $favorite);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity updated successfully',
            'book_id' => $book_id,
            'quantity' => $quantity,
        ]);
    }

    public function moveToCart(Request $request)
    {
        $books = $request->input('books', []);
        $user_id = Auth::guard('web')->id();
        $bookQuantity = 1;
        foreach ($books as $book_slug) {
            $book = Book::where('slug', $book_slug)->firstOrFail();
            $book_id = $book->id;
            if (Auth::guard('web')->check()) {
                if ($book->favorite()->where('user_id', $user_id)->exists()) {
                    $favorite = Session::get('favorite', []);

                    $favoriteRecord = AddToFavorite::where('user_id', $user_id)->where('book_id', $book_id)->firstOrFail();
                    $bookQuantity = $favoriteRecord->quantity;
                    AddToCart::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id], [
                        'quantity' => $bookQuantity,
                    ]);
                    redirect()->back()->with('success', __('website/favorite.book_moved_to_cart_successfully'));
                } else {
                    AddToCart::updateOrCreate(['user_id' => $user_id, 'book_id' => $book_id], ['quantity' => $bookQuantity]);
                }
                AddToFavorite::where('user_id', $user_id)->where('book_id', $book_id)->delete();
            } else {
                $favorite = Session::get('favorite', []);
                $bookQuantity = $favorite[$book_id] ?? 1;
                $cart = Session::get('cart', []);
                if (session('favorite') && array_key_exists($book_id, session('favorite'))) {
                    $cart[$book_id] = $bookQuantity;
                    Session::put('cart', $cart);
                } else {
                    $cart[$book_id] = $bookQuantity;
                    Session::put('cart', $cart);
                }
                unset($favorite[$book_id]);
                Session::put('favorite', $favorite);
            }
        }

        return redirect()->back()->with('success', __('website/favorite.book_moved_to_cart_successfully'));
    }

    public function syncFavoriteFromSessionToDatabase()
    {
        $user_id = Auth::guard('web')->id();
        $favoriteItems = Session::get('favorite', []);

        if (! empty($favoriteItems)) {
            foreach ($favoriteItems as $bookId) {
                AddToFavorite::updateOrCreate(
                    ['user_id' => $user_id, 'book_id' => $bookId],
                );
            }
            Session::forget('favorite');
        }
    }
}
