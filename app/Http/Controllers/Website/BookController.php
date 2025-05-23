<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return view('website.pages.book.index');
    }

    public function show(Book $book)
    {
        return view('website.pages.book.show', compact('book'));
    }
}
