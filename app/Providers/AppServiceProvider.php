<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Alkoumi\LaravelArabicNumbers\LaravelArabicNumbersServiceProvider;
use App\Faker\CategoryProvider;

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
        LaravelArabicNumbersServiceProvider::class;
    }
}
