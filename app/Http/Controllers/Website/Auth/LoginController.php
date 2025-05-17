<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerifyAccountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('website.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user_data = $request->validated();

        if (! $user) {
            return back()->with('errorForm', 'Invalid Credientials!');
        }

        if (! Hash::check($user_data['password'], $user->password)) {
            return back()->with('errorForm', 'Invalid Credientials!');
        }

        if (! $user->email_verified_at) {
            Mail::to($user->email)->send(new VerifyAccountMail($user->otp, $user->email));

            return redirect()->route('front.auth.email.verify', $user->email);
        }

        if (Auth::guard('web')->attempt($user_data)) {
            return redirect()->intended('/');
        }

        return back()->with('errorForm', 'Invalid Credientials!');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('front.home.index');
    }
}
