<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PimpinanController;
use App\Models\Berita;
use App\Models\Pimpinan;
use Illuminate\Support\Facades\Route;

// ================= HALAMAN PUBLIK =================
Route::get('/', function () {
    $beritas   = Berita::latest()->take(3)->get();
    $pimpinans = Pimpinan::orderBy('urutan', 'asc')->get();
    return view('home', compact('beritas', 'pimpinans'));
})->name('home');

Route::post('/kirim-pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// ================= AUTENTIKASI ADMIN (URL RAHASIA) =================
Route::get('/hihuu', [AuthController::class, 'showLogin'])->name('login');
Route::post('/hihuu', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= HALAMAN ADMIN (WAJIB LOGIN) =================
Route::middleware('auth')->group(function () {
    // Kelola Pesan Masuk
    Route::get('/admin/pesan', [PesanController::class, 'index'])->name('admin.pesan');
    Route::delete('/admin/pesan/{pesan}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');

    // Kelola Berita / Blog
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Kelola Pimpinan Sekolah (Kepsek & Wakasek)
    Route::get('/admin/pimpinan', [PimpinanController::class, 'index'])->name('admin.pimpinan');
    Route::post('/admin/pimpinan', [PimpinanController::class, 'store'])->name('admin.pimpinan.store');
    Route::put('/admin/pimpinan/{pimpinan}', [PimpinanController::class, 'update'])->name('admin.pimpinan.update');
    Route::delete('/admin/pimpinan/{pimpinan}', [PimpinanController::class, 'destroy'])->name('admin.pimpinan.destroy');
});