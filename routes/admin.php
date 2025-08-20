<?php
// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\TempatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\HistoryMateriController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    
    /**
     * DASHBOARD
     */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /**
     * DIVISI
     */
    Route::resource('divisi', DivisiController::class);

    /**
     * TEMPAT
     */
    Route::resource('tempat', TempatController::class);

    /**
     * USERS
     * - CRUD User
     * - Endpoint tambahan untuk AJAX get-tempat
     */
    Route::resource('users', UserController::class);
    Route::get('users/get-tempat/{divisiId}', [UserController::class, 'getTempatByDivisi'])
        ->name('admin.users.get-tempat');

    /**
     * MATERI
     * Kelompokkan semua route materi dalam prefix & name space yang sama
     */
    Route::prefix('materi')->name('materi.')->group(function () {
        
        // Ekspor Excel
        Route::get('export-excel', [HistoryMateriController::class, 'exportExcel'])
            ->name('exportExcel');

        // Riwayat Materi
        Route::get('history', [HistoryMateriController::class, 'index'])
            ->name('history');

        // Endpoint AJAX untuk get-tempat pada materi
        Route::get('get-tempat/{divisiId}', [HistoryMateriController::class, 'getTempatByDivisi'])
            ->name('admin.materi.get-tempat');

        // CRUD Materi
        Route::get('/', [MateriController::class, 'index'])->name('index');
        Route::get('/create', [MateriController::class, 'create'])->name('create');
        Route::post('/', [MateriController::class, 'store'])->name('store');
        Route::get('/{materi}/edit', [MateriController::class, 'edit'])->name('edit');
        Route::put('/{materi}', [MateriController::class, 'update'])->name('update');
        Route::delete('/{materi}', [MateriController::class, 'destroy'])->name('destroy');
    });

});


// Pastikan rute ini tidak berada di dalam middleware group jika tidak perlu
Route::get('/get-tempat/{divisiId}', [MateriController::class, 'getTempatByDivisi']);
Route::get('/get-tempat/{divisiId}', [UserController::class, 'getTempatByDivisi']);
