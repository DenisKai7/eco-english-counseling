<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';
    public const ADMIN_DASHBOARD = '/admin/dashboard';
    public const MENTOR_DASHBOARD = '/mentor/dashboard';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Memuat rute admin dari file terpisah
            // Middleware 'auth' dan 'role:admin' akan diterapkan di routes/admin.php itu sendiri
            Route::middleware('web') // Middleware 'web' untuk session, CSRF, dll.
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            // Memuat rute mentor dari file terpisah
            // Middleware 'auth' dan 'role:mentor' akan diterapkan di routes/mentor.php itu sendiri
            Route::middleware('web') // Middleware 'web' untuk session, CSRF, dll.
                ->prefix('mentor')
                ->name('mentor.')
                ->group(base_path('routes/mentor.php'));
        });
    }
}