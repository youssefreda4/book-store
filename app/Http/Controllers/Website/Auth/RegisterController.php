<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\VerifyAccountMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('website.auth.register');
    }

    protected function create(UserRequest $request)
    {
        $user_data = $request->validated();
        $user = User::create([
            'username' => $user_data['username'],
            'first_name' => $user_data['first_name'],
            'last_name' => $user_data['last_name'],
            'email' => $user_data['email'],
            'password' => $user_data['password'],
            'otp' => rand(100000, 999999),
        ]);
        Mail::to($user->email)->send(new VerifyAccountMail($user->otp, $user->email));

        return redirect()->route('email.verify', $user->email);
    }
}
