<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function changeLanguage($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
