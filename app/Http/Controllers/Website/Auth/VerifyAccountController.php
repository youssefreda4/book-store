<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyAccountController extends Controller
{
    public function index($email)
    {
        return view('website.auth.verify-email',compact('email'));
    }

    public function verifyAccount(VerifyAccountRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->otp != implode("", $request->otp)) {
            return back()->with('errorForm', 'Invalid OTP or email address');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('front.auth.login')->with('success', 'Email verified successfully, you can login now');
    }
}
