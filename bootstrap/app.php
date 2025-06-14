<?php

use Alkoumi\LaravelArabicNumbers\Http\Middleware\ConvertArabicDigitsToEnlishMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\UserCheckMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;




return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('/dashboard')
                ->name('dashboard.')
                ->group(base_path('routes/dashboard.php'));
            Route::middleware('web')
                ->prefix('/dashboard')
                ->name('dashboard.')
                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('dashboard', [
            'auth:admin',
            'admin.check',
            SetLocale::class,
            ConvertArabicDigitsToEnlishMiddleware::class,
        ]);
        $middleware->appendToGroup('front', [
            'user.check',
            SetLocale::class,
            ConvertArabicDigitsToEnlishMiddleware::class,
        ]);

        $middleware->alias([
            'authenticated' => RedirectIfAuthenticated::class,
            'admin.check' => AdminCheckMiddleware::class,
            'user.check' => UserCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
