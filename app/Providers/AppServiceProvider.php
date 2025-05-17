<?php

namespace App\Providers;

use Alkoumi\LaravelArabicNumbers\LaravelArabicNumbersServiceProvider;
use App\Faker\CategoryProvider;
use App\Models\AddToCart;
use App\Models\AddToFavorite;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;

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

        View::composer('website.layouts.nav', function ($view) {
            if (Auth::guard('web')->check()) {
                $cartCount = AddToCart::where('user_id', auth('web')->id())->count();
                $favoriteCount = AddToFavorite::where('user_id', auth('web')->id())->count();
            } else {
                $cartCount = count(session('cart', []));
                $favoriteCount = count(session('favorite', []));
            }
            $view->with([
                'cartCount' => $cartCount,
                'favoriteCount' => $favoriteCount,
            ]);
        });
    }
}
