<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MateriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Pastikan kamu mengimpor controller yang diperlukan di bagian atas file

Route::middleware(['auth', 'role:user'])->group(function () {

    // Rute untuk dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Rute untuk daftar materi
    Route::get('/materi', [MateriController::class, 'index'])->name('user.materi.index');
    
    // Rute untuk melihat detail atau preview materi di dalam web
    // Rute ini sudah diperbaiki agar lebih sesuai dengan konvensi Laravel
    
    Route::get('/materi/{materi}', [MateriController::class, 'view'])->name('user.materi.view');

    // Rute untuk mengunduh materi (download)
    Route::get('/materi/download/{materi}', [MateriController::class, 'download'])->name('user.materi.download');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/get-tempat/{divisiId}', [MateriController::class, 'getTempatByDivisi']);

require __DIR__.'/auth.php';