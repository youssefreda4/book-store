<?php

use App\Http\Controllers\Dashboard\AdminManagementController;
use App\Http\Controllers\Dashboard\AuthorController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DiscountController;
use App\Http\Controllers\Dashboard\ExportExcelController;
use App\Http\Controllers\Dashboard\FlashSaleController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ImportExcelController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PublisherController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ShippingAreaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

    Route::middleware(['can:super-admin'])->group(function () {
        Route::post('/delete-items', [HomeController::class, 'bulkDelete'])->name('items.bulkdelete');
        Route::post('/import/excel', ImportExcelController::class)->name('import.excel');
        Route::get('/import/export', ExportExcelController::class)->name('export.excel');
    });

    Route::name('discounts.')->prefix('discounts')->controller(DiscountController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{discount}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{discount}/edit', 'edit')->name('edit');
            Route::put('/{discount}', 'update')->name('update');
            Route::delete('/{discount}', 'destroy')->name('destroy');
        });
    });

    Route::name('categories.')->prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{category}/show', 'show')->name('show');
            Route::post('/add/discount/{category}', 'addDiscount')->name('add.discount');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{category}/edit', 'edit')->name('edit');
            Route::put('/{category}', 'update')->name('update');
            Route::delete('/{category}', 'destroy')->name('destroy');
        });
    });

    Route::name('areas.')->prefix('areas')->controller(ShippingAreaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{area}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{area}/edit', 'edit')->name('edit');
            Route::put('/{area}', 'update')->name('update');
            Route::delete('/{area}', 'destroy')->name('destroy');
        });
    });

    Route::name('publishers.')->prefix('publishers')->controller(PublisherController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{publisher}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{publisher}/edit', 'edit')->name('edit');
            Route::put('/{publisher}', 'update')->name('update');
            Route::delete('/{publisher}', 'destroy')->name('destroy');
        });
    });

    Route::name('authors.')->prefix('authors')->controller(AuthorController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{author}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{author}/edit', 'edit')->name('edit');
            Route::put('/{author}', 'update')->name('update');
            Route::delete('/{author}', 'destroy')->name('destroy');
        });
    });

    Route::name('flashsales.')->prefix('flashsales')->controller(FlashSaleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{flashsale}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{flashsale}/edit', 'edit')->name('edit');
            Route::put('/{flashsale}', 'update')->name('update');
            Route::delete('/{flashsale}', 'destroy')->name('destroy');
        });
    });

    Route::name('books.')->prefix('books')->controller(BookController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{book}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{book}/edit', 'edit')->name('edit');
            Route::put('/{book}', 'update')->name('update');
            Route::delete('/{book}', 'destroy')->name('destroy');
        });
    });

    Route::name('orders.')->prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::name('admins.')->prefix('admins')->controller(AdminManagementController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware(['can:super-admin'])->group(function () {
            Route::get('/{admin}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{admin}/edit', 'edit')->name('edit');
            Route::put('/{admin}', 'update')->name('update');
            Route::delete('/{admin}', 'destroy')->name('destroy');
        });
    });

    Route::prefix('reports')->name('report.')->controller(ReportController::class)->group(function () {
        Route::prefix('sales')->name('sales.')->group(function () {
            Route::get('/books', 'books')->name('books');
            Route::get('/revenue', 'revenue')->name('revenue');
            Route::get('/trends', 'trends')->name('trends');
        });
        Route::prefix('sold')->name('most.selling.')->group(function () {
            Route::get('/books', 'soldBooks')->name('books');
        });
    });
});

Auth::routes();
