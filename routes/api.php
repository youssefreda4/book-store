<?php

use App\Http\Controllers\Dashboard\AdminManagmentController;
use App\Http\Controllers\Dashboard\AuthorController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DiscountController;
use App\Http\Controllers\Dashboard\FlashSaleController;
use App\Http\Controllers\Dashboard\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('discount')->name('discounts.')->group(function(){
    Route::get('/search',[DiscountController::class, 'search'])->name('search');
});

Route::prefix('flashsale')->name('flashsales.')->group(function(){
    Route::get('/search',[FlashSaleController::class, 'search'])->name('search');
});

Route::prefix('catrgory')->name('categories.')->group(function(){
    Route::get('/search',[CategoryController::class, 'search'])->name('search');
});

Route::prefix('author')->name('authors.')->group(function(){
    Route::get('/search',[AuthorController::class, 'search'])->name('search');
});

Route::prefix('publisher')->name('publishers.')->group(function(){
    Route::get('/search',[PublisherController::class, 'search'])->name('search');
});
