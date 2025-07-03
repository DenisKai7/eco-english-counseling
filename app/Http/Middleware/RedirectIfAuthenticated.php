<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Logika pengarahan jika user SUDAH login dan mencoba akses halaman guest (login/register)
                if ($guard === 'web') {
                    $user = Auth::guard($guard)->user();
                    if ($user->role === 'admin') {
                        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
                    } elseif ($user->role === 'mentor') {
                        return redirect(RouteServiceProvider::MENTOR_DASHBOARD);
                    } else { // role 'user' atau lainnya
                        return redirect(RouteServiceProvider::HOME);
                    }
                }
                // Untuk guard lain (misal 'mentor' guard dari tabel 'mentors')
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}