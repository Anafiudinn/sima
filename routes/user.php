<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MateriController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HistoryDownloadController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Routes User (Login Required)
|--------------------------------------------------------------------------
| Routes ini hanya bisa diakses oleh user dengan role 'user'.
| Middleware: 'auth' + 'role:user'
| Contohnya:
| - Dashboard user
| - Daftar materi user
| - Download materi
| - Riwayat unduhan
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    // Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Daftar materi user
    Route::get('/materi', [MateriController::class, 'index'])->name('user.materi.index');

    // Detail/preview materi user
    Route::get('/materi/{materi}', [MateriController::class, 'view'])->name('user.materi.view');

    // Download materi user
    Route::get('/materi/download/{materi}', [MateriController::class, 'download'])->name('user.materi.download');

    // Riwayat unduhan user
    Route::get('/history-unduhan', [HistoryDownloadController::class, 'index'])->name('user.history.index');
});

/*
|--------------------------------------------------------------------------
| Routes Authenticated (Umum)
|--------------------------------------------------------------------------
| Routes ini bisa diakses oleh user yang sudah login tanpa
| memandang role.
| Contohnya:
| - Profile edit, update, destroy
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route tambahan: ambil tempat berdasarkan divisi
Route::get('/get-tempat/{divisiId}', [MateriController::class, 'getTempatByDivisi']);

// Routes auth bawaan Laravel Breeze
require __DIR__ . '/auth.php';