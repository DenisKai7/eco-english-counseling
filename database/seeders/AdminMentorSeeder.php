<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;

class AdminMentorSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin ECO',
            'email' => 'admin@eco.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@eco.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Buat Mentor yang terdaftar via publik (di tabel users) DAN di tabel mentors
        $publicMentorUser = User::create([
            'name' => 'Mentor Publik',
            'email' => 'mentor_public@eco.com',
            'password' => Hash::make('password'),
            'role' => 'mentor', // Role di tabel users
        ]);

        Mentor::create([
            'name' => $publicMentorUser->name,
            'email' => $publicMentorUser->email,
            'password' => $publicMentorUser->password,
            'specialization' => 'English for Special Needs (Public)',
            'phone_number' => '08111111111',
            'bio' => 'Mentor terdaftar via form publik.',
            'user_id' => $publicMentorUser->id, // Hubungkan ke user_id
        ]);

        // Buat Mentor yang hanya ada di tabel mentors (dibuat admin)
        Mentor::create([
            'name' => 'Mentor Admin Buat',
            'email' => 'mentor_admin@eco.com',
            'password' => Hash::make('password'),
            'specialization' => 'Counseling (Admin)',
            'phone_number' => '08222222222',
            'bio' => 'Mentor yang dibuat langsung oleh Admin.',
            'user_id' => null, // Tidak terhubung ke user di tabel users
        ]);
    }
}