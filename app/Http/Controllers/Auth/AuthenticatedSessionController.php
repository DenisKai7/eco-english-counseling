<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider; // Pastikan ini ada
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Melakukan proses autentikasi

        $request->session()->regenerate();

        // --- LOGIKA PENGARAHAN BARU DI SINI ---
        $user = Auth::user(); // Dapatkan user yang baru login

        if ($user->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        } elseif ($user->role === 'mentor') {
            return redirect()->intended(RouteServiceProvider::MENTOR_DASHBOARD);
        } else { // role 'user' atau lainnya
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // --- AKHIR LOGIKA PENGARAHAN BARU ---
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}