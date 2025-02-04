<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DiscountController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('discount')->name('discounts.')->group(function(){
    Route::get('/search',[DiscountController::class, 'search'])->name('search');
});