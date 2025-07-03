<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\MentorAuthenticatedSessionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\RegisteredUserController; // Pastikan ini ada
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DevelopmentController;

// Frontend Routes (Public Access)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/articles', [HomeController::class, 'articles'])->name('articles.index');
Route::get('/articles/{article:slug}', [HomeController::class, 'showArticle'])->name('articles.show');
Route::get('/materials', [HomeController::class, 'materials'])->name('materials.index');
Route::get('/materials/{material:slug}', [HomeController::class, 'showMaterial'])->name('materials.show');
Route::get('/counseling', [HomeController::class, 'counseling'])->name('counseling.index');

// Auth Routes (Laravel Breeze default for Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard & Chat
    Route::get('/dashboard', function () {
        // Redirect logic moved to RedirectIfAuthenticated middleware for cleaner separation
        return view('dashboard'); // Ini adalah dashboard default untuk user biasa
    })->name('dashboard');

    Route::get('/counseling/chat/{mentor}', [UserController::class, 'startChat'])->name('user.counseling.chat');
    Route::post('/counseling/chat/{mentor}', [UserController::class, 'sendMessage'])->name('user.counseling.sendMessage');
});

require __DIR__.'/auth.php'; // Includes standard login/register/logout routes for 'web' guard

// Mentor Login/Logout (untuk mentor di tabel 'mentors' terpisah)
Route::get('mentor/login', [MentorAuthenticatedSessionController::class, 'create'])->name('mentor.login');
Route::post('mentor/login', [MentorAuthenticatedSessionController::class, 'store']);
Route::post('mentor/logout', [MentorAuthenticatedSessionController::class, 'destroy'])->name('mentor.logout');

// Memuat rute Admin dari file terpisah
Route::prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));

// Memuat rute Mentor dari file terpisah
Route::prefix('mentor')->name('mentor.')->group(base_path('routes/mentor.php'));

// Rute untuk upload file dari Rich Text Editor
Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');
Route::post('/upload/audio', [UploadController::class, 'uploadAudio'])->name('upload.audio'); // Jika Anda ingin upload audio terpisah

// Rute Pengembangan
Route::get('/development', [DevelopmentController::class, 'index'])->name('development.index');
Route::get('/development/form/{roleType}', [DevelopmentController::class, 'showForm'])->name('development.form.show');
Route::post('/development/form/{roleType}', [DevelopmentController::class, 'storeForm'])->name('development.form.store');