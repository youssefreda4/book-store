<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('website.auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $result = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$result) {
            return back()->with('error', 'Invalid token or email address');
        }

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => $request->password,
        ]);

        return redirect()->route('front.auth.login')->with('success', 'Password reset successfully you can login now');
    }
}
