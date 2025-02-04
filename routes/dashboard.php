<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DiscountController;


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::name('discounts.')->prefix('discounts')->controller(DiscountController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/{discount}/show',  'show')->name('show');
        Route::get('/create',  'create')->name('create');
        Route::post('/',  'store')->name('store');
        Route::get('/{discount}/edit',  'edit')->name('edit');
        Route::put('/{discount}',  'update')->name('update');
        Route::delete('/{discount}',  'destroy')->name('destroy');
    });
    Route::name('categories.')->prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/{category}/show',  'show')->name('show');
        Route::post('/add/discount/{category}',  'addDiscount')->name('add.discount');
        Route::get('/create',  'create')->name('create');
        Route::post('/',  'store')->name('store');
        Route::get('/{category}/edit',  'edit')->name('edit');
        Route::put('/{category}',  'update')->name('update');
        Route::delete('/{category}',  'destroy')->name('destroy');
    });
});
