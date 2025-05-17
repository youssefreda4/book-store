<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return view('website.pages.book.index');
    }
}
