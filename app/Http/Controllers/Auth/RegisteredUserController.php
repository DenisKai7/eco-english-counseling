<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mentor; // Tambahkan ini
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View { return view('auth.register'); }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,mentor'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika user mendaftar sebagai mentor, buat entri di tabel mentors juga
        if ($user->role === 'mentor') {
            Mentor::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password, // Gunakan hash password yang sama
                'user_id' => $user->id, // Hubungkan dengan user_id yang baru dibuat
                'specialization' => null, // Bisa diisi nanti oleh mentor di profil
                'phone_number' => null,
                'bio' => null,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Logika pengarahan setelah login berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'mentor') {
            return redirect()->route('mentor.dashboard');
        } else {
            return redirect(route('dashboard', absolute: false)); // Default untuk role 'user'
        }
    }
}