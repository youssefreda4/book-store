<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Alkoumi\LaravelArabicNumbers\Http\Middleware\ConvertArabicDigitsToEnlishMiddleware;

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
        $middleware->appendToGroup('dashboard',[
            'auth:admin',
            SetLocale::class,
            ConvertArabicDigitsToEnlishMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
