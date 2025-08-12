<?php
// routes/admin.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\TempatController;
use App\Http\Controllers\Admin\HistoryMateriController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('divisi', DivisiController::class);
    Route::resource('tempat', TempatController::class);

    Route::resource('users', UserController::class);

    // --- Definisi Rute Materi yang Spesifik di atas Rute Umum ---

    // Kelompokkan rute materi dengan prefix dan name yang sama
    Route::prefix('materi')->name('materi.')->group(function () {
        // Rute untuk ekspor Excel (paling spesifik)
        Route::get('export-excel', [HistoryMateriController::class, 'exportExcel'])->name('exportExcel');

        // Rute untuk riwayat materi (juga spesifik)
        Route::get('history', [HistoryMateriController::class, 'index'])->name('history');
        Route::get('/admin/materi/get-tempat/{divisiId}', [HistoryMateriController::class, 'getTempatByDivisi'])->name('admin.materi.get-tempat');

        // Rute resource untuk CRUD materi, didefinisikan secara manual untuk menghindari konflik
        Route::get('/', [MateriController::class, 'index'])->name('index');
        Route::get('/create', [MateriController::class, 'create'])->name('create');
        Route::post('/', [MateriController::class, 'store'])->name('store');
        Route::get('/{materi}/edit', [MateriController::class, 'edit'])->name('edit');
        Route::put('/{materi}', [MateriController::class, 'update'])->name('update');
        Route::delete('/{materi}', [MateriController::class, 'destroy'])->name('destroy');
        // Jika ada, rute show diletakkan di akhir
        // Route::get('/{materi}', [MateriController::class, 'show'])->name('show');
    });
    
});

// Pastikan rute ini tidak berada di dalam middleware group jika tidak perlu
Route::get('/get-tempat/{divisiId}', [MateriController::class, 'getTempatByDivisi']);
