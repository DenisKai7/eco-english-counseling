<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\User\UserController;
use App\Models\DevelopmentForm; // Diperlukan untuk chat jika mentor membalas user

/*
|--------------------------------------------------------------------------
| Mentor Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group and "mentor" prefix/name.
|
*/

// Rute untuk mentor yang login melalui 'web' guard (dari tabel 'users' dengan role 'mentor')
// DAN mentor yang login melalui 'mentor' guard (dari tabel 'mentors' terpisah)
// Middleware 'auth' akan menangani kedua guard (web/mentor) secara otomatis jika dikonfigurasi di Kernel.php
// Middleware 'role:mentor' akan memastikan hanya user dengan role 'mentor' atau mentor dari tabel 'mentors' yang bisa akses.
// Catatan: Untuk 'auth' middleware, jika Anda ingin spesifik hanya untuk guard 'web' atau 'mentor',
// Anda bisa menggunakan 'auth:web' atau 'auth:mentor'. Namun, karena kita ingin keduanya bisa akses
// dashboard mentor, kita bisa mengandalkan logika di `RedirectIfAuthenticated` dan `RoleMiddleware`.
// Untuk kesederhanaan, kita akan menggunakan 'auth' dan 'role:mentor'.

Route::middleware(['auth', 'verified', 'role:mentor'])->group(function () {
    // Dashboard Mentor
    Route::get('/dashboard', [MentorDashboardController::class, 'index'])->name('dashboard');

    // CRUD Materials
    Route::get('/materials', [MentorDashboardController::class, 'materials'])->name('materials.index');
    Route::get('/materials/create', [MentorDashboardController::class, 'createMaterial'])->name('materials.create');
    Route::post('/materials', [MentorDashboardController::class, 'storeMaterial'])->name('materials.store');
    Route::get('/materials/{material}/edit', [MentorDashboardController::class, 'editMaterial'])->name('materials.edit');
    Route::put('/materials/{material}', [MentorDashboardController::class, 'updateMaterial'])->name('materials.update');
    Route::delete('/materials/{material}', [MentorDashboardController::class, 'destroyMaterial'])->name('materials.destroy');

    // Chat Management for Mentor
    Route::get('/chats', [MentorDashboardController::class, 'chats'])->name('chats.index');
    Route::get('/chats/{user}', [MentorDashboardController::class, 'showChat'])->name('chats.show');
    Route::post('/chats/{user}', [MentorDashboardController::class, 'sendMessage'])->name('chats.sendMessage');

    // Development Form Review for Mentor
    Route::get('/development-forms', [MentorDashboardController::class, 'developmentForms'])->name('development.forms.index'); // Opsional: daftar semua form
    Route::get('/development-forms/{form}', [MentorDashboardController::class, 'reviewForm'])->name('development.review');
    Route::post('/development-forms/{form}/feedback', [MentorDashboardController::class, 'storeFeedback'])->name('development.storeFeedback');
});