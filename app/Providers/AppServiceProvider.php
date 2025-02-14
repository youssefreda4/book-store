<?php

namespace App\Providers;

use App\Faker\CategoryProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use Alkoumi\LaravelArabicNumbers\LaravelArabicNumbersServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        fake()->addProvider(new CategoryProvider(fake()));
        Paginator::useBootstrapFive();
        ExcelServiceProvider::class;
        LaravelArabicNumbersServiceProvider::class;

        Gate::define('super-admin', function () {
            return Auth::guard('admin')->user()->type === 'super-admin';
        });
    }
}
