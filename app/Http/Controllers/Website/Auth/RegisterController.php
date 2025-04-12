<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
 
use Illuminate\Support\Facades\Auth;
 


class RegisterController extends Controller
{
    public function index()
    {
        return view('website.auth.register');
    }

    protected function create(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        Auth::guard('web')->login($user);
        return redirect()->route('front.home.index');
    }
}
