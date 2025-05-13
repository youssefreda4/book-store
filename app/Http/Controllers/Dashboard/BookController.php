<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::filter(request()->all())
            ->with(['media', 'author', 'category', 'favorite', 'publisher', 'discountable'])
            ->latest('id')
            ->paginate();
        return view('dashboard.book.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('dashboard.book.show', compact('book'));
    }

    public function create()
    {
        return view('dashboard.book.create');
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();
        $book = Book::create($data);
        if ($request->hasFile('image')) {
            $book->addMediaFromRequest('image')->toMediaCollection('book');
        }
        return redirect()->route('dashboard.books.index')->with('success', __('book.book_created_successfully'));
    }

    public function edit(Book $book)
    {
        return view('dashboard.book.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        if ($request->hasFile('image')) {
            $book->clearMediaCollection('book');
            $book->addMediaFromRequest('image')
                ->toMediaCollection('book');
        }
        $data = $request->validated();
        $book->update($data);
        return redirect()->route('dashboard.books.index')->with('success', __('book.book_updated_successfully'));
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('dashboard.books.index')->with('success', __('book.book_deleted_successfully'));
    }
}
