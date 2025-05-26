<?php

use App\Http\Controllers\Website\Auth\ForgotPasswordController;
use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\Auth\RegisterController;
use App\Http\Controllers\Website\Auth\ResetPasswordController;
use App\Http\Controllers\Website\Auth\SocialAuthController;
use App\Http\Controllers\Website\Auth\VerifyAccountController;
use Illuminate\Support\Facades\Route;


Route::name('front.auth.')->middleware('front')->group(function () {
    Route::middleware(['authenticated'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'create'])->name('register.store');
        Route::post('/login', [LoginController::class, 'login'])->name('login.check');

        Route::get('/auth/{driver}/redirect', [SocialAuthController::class, 'redirect'])->name('redirect');
        Route::get('/auth/{driver}/callback', [SocialAuthController::class, 'callback'])->name('callback');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'forget'])->name('password.email');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });

    Route::middleware(['guest.redirect'])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/verify-email/{email}', [VerifyAccountController::class, 'index'])->name('email.verify');
        Route::post('/verify-email', [VerifyAccountController::class, 'verifyAccount'])->name('email.send.verify');
    });
});
