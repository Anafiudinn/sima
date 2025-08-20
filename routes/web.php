<?php

use App\Http\Controllers\PublicMateriController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dalam sebuah grup
| yang berisi middleware "web" dan lainnya.
|
*/

// Rute Publik (Guest)
// Menggunakan HomeController untuk mengelola data di halaman utama
Route::get('/', [HomeController::class, 'index'])->name('public.home');

// Rute untuk Halaman Materi
// Rute untuk Halaman Materi
Route::get('/public/materi', [PublicMateriController::class, 'index'])->name('public.materi.index');
Route::get('/public/materi/{materi}', [PublicMateriController::class, 'view'])->name('public.materi.view');

// Rute untuk Halaman Kontak
Route::view('/kontak-kami', 'public.kontak')->name('public.kontak');

// Rute untuk AJAX: ambil tempat berdasarkan divisi
Route::get('/get-tempat/{divisiId}', [PublicMateriController::class, 'getTempatByDivisi']);

// Rute untuk Otentikasi (Auth) bawaan Laravel Breeze
require __DIR__ . '/auth.php';