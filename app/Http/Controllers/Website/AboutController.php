<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('website.pages.about.index');
    }
}
