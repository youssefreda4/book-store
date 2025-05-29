<?php

use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\BookController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\FavoriteController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\PaymentController;
use App\Http\Controllers\Website\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::name('front.')->middleware('front')->group(function () {

    Route::name('home.')->controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'searchForBooks')->name('search');
        Route::get('change-language/{lang}', 'changeLanguage')->name('change.language');
    });

    Route::name('books.')->prefix('books')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{book}', 'show')->name('show');
    });

    Route::name('about.')->controller(AboutController::class)->group(function () {
        Route::get('/about', 'index')->name('index');
    });

    Route::name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('index');
    });

    Route::name('cart.')->prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('item/{book}', 'addItem')->name('add');
        Route::put('item/{book}', 'updateItem')->name('update');
        Route::delete('item/{book}', 'removeItem')->name('remove');
    });

    Route::name('favorite.')->prefix('favorite')->controller(FavoriteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('item/{book}', 'favoriteActionButton')->name('action');
        Route::put('item/{book}', 'updateItem')->name('update');
        Route::post('item/move/cart', 'moveToCart')->name('move');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::name('order.')->prefix('order')->controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'create')->name('create');
            Route::get('/{order:number}', 'show')->name('show');
        });

        Route::name('profile.')->prefix('profile')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });

        Route::get('/pay', [PaymentController::class, 'pay']);
        // Route::get('/callback', [PaymentController::class, 'callback']);
        Route::get('/callback', [OrderController::class, 'callback']);
    });
});
require __DIR__ . '/auth.php';

// Auth::routes();
