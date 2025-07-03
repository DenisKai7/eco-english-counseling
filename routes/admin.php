<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group and "admin" prefix/name.
|
*/

// Rute ini dilindungi oleh middleware 'auth' (untuk guard 'web') dan 'role:admin'
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Users
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminDashboardController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminDashboardController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');

    // CRUD Mentors (Admin mengelola mentor di tabel 'mentors' terpisah)
    Route::get('/mentors', [AdminDashboardController::class, 'mentors'])->name('mentors.index');
    Route::get('/mentors/create', [AdminDashboardController::class, 'createMentor'])->name('mentors.create');
    Route::post('/mentors', [AdminDashboardController::class, 'storeMentor'])->name('mentors.store');
    Route::get('/mentors/{mentor}/edit', [AdminDashboardController::class, 'editMentor'])->name('mentors.edit');
    Route::put('/mentors/{mentor}', [AdminDashboardController::class, 'updateMentor'])->name('mentors.update');
    Route::delete('/mentors/{mentor}', [AdminDashboardController::class, 'destroyMentor'])->name('mentors.destroy');

    // CRUD Articles
    Route::get('/articles', [AdminDashboardController::class, 'articles'])->name('articles.index');
    Route::get('/articles/create', [AdminDashboardController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminDashboardController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminDashboardController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminDashboardController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminDashboardController::class, 'destroyArticle'])->name('articles.destroy');
});