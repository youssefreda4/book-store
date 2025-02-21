<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\BookController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\ContactController;

Route::name('front.')->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home.index');
    });

    Route::name('books.')->prefix('books')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::name('about.')->controller(AboutController::class)->group(function () {
        Route::get('/about', 'index')->name('index');
    });

    Route::name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('index');
    });
});

// Auth::routes();
