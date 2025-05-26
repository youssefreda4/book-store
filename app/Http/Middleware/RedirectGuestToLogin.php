<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectGuestToLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'web'): Response
    {
        if (!Auth::guard($guard)->check()) {
            $request->session()->put('url.intended', $request->fullUrl());

            return redirect()->route('front.auth.login');
        }

        return $next($request);
    }
}
