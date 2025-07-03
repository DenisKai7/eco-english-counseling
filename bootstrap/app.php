<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias middleware Anda di sini
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            // Anda bisa menambahkan alias middleware kustom lainnya di sini jika diperlukan
        ]);

        // Middleware groups atau global middleware juga bisa ditambahkan di sini
        // Contoh:
        // $middleware->web(append: [
        //     \App\Http\Middleware\TrustProxies::class,
        // ]);
        // $middleware->api(prepend: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();