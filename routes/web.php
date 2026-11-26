<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\VisiMisiController;
use App\Models\Berita;
use App\Models\Dudi;
use App\Models\Faq;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\KuisSoal;
use App\Models\Pimpinan;
use App\Models\VisiMisi;
use Illuminate\Support\Facades\Route;

// ================= HALAMAN PUBLIK =================
Route::get('/', function () {
    $beritas = Berita::tayang()
        ->orderByRaw('COALESCE(jadwal_tayang, created_at) DESC')
        ->take(3)
        ->get();
    $pimpinans = Pimpinan::orderBy('urutan', 'asc')->get();
    $gurus     = Guru::orderBy('urutan', 'asc')->orderBy('nama', 'asc')->get();
    $dudis     = Dudi::orderBy('urutan', 'asc')->orderBy('nama', 'asc')->get();
    $visi      = VisiMisi::where('jenis', 'visi')->first();
    $misis     = VisiMisi::where('jenis', 'misi')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
    $jurusans  = Jurusan::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
    $faqs      = Faq::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
    $kuisSoals = KuisSoal::with('opsis.jurusan')
        ->orderBy('urutan', 'asc')
        ->orderBy('id', 'asc')
        ->get();

    return view('home', compact('beritas', 'pimpinans', 'gurus', 'dudis', 'visi', 'misis', 'jurusans', 'faqs', 'kuisSoals'));
})->name('home');

Route::post('/kirim-pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// ================= AUTENTIKASI ADMIN (URL RAHASIA) =================
Route::get('/hihuu', [AuthController::class, 'showLogin'])->name('login');
Route::post('/hihuu', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= PENGALIHAN UTAMA SETELAH LOGIN =================
Route::middleware('auth')->get('/admin', function () {
    if (auth()->user()->isPenulis()) {
        return redirect()->route('admin.berita');
    }
    return redirect()->route('admin.dashboard');
});

// ================= HALAMAN KHUSUS SUPER ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Halaman Utama Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Kelola Visi & Misi Sekolah
    Route::get('/admin/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visimisi');
    Route::post('/admin/visi', [VisiMisiController::class, 'updateVisi'])->name('admin.visi.update');
    Route::post('/admin/misi', [VisiMisiController::class, 'storeMisi'])->name('admin.misi.store');
    Route::put('/admin/misi/{id}', [VisiMisiController::class, 'updateMisi'])->name('admin.misi.update');
    Route::delete('/admin/misi/{id}', [VisiMisiController::class, 'destroyMisi'])->name('admin.misi.destroy');

    // Kelola Kompetensi Keahlian (Jurusan)
    Route::get('/admin/jurusan', [JurusanController::class, 'index'])->name('admin.jurusan');
    Route::post('/admin/jurusan', [JurusanController::class, 'store'])->name('admin.jurusan.store');
    Route::put('/admin/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('admin.jurusan.update');
    Route::delete('/admin/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');

    // Kelola Kuis Rekomendasi Jurusan
    Route::get('/admin/kuis', [KuisController::class, 'index'])->name('admin.kuis');
    Route::post('/admin/kuis', [KuisController::class, 'store'])->name('admin.kuis.store');
    Route::put('/admin/kuis/{kuis}', [KuisController::class, 'update'])->name('admin.kuis.update');
    Route::delete('/admin/kuis/{kuis}', [KuisController::class, 'destroy'])->name('admin.kuis.destroy');

    // Kelola Pertanyaan Umum (FAQ)
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('/admin/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::put('/admin/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/admin/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

    // Kelola Pesan Masuk
    Route::get('/admin/pesan', [PesanController::class, 'index'])->name('admin.pesan');
    Route::delete('/admin/pesan/{pesan}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');

    // Kelola Pimpinan Sekolah (Kepsek & Wakasek)
    Route::get('/admin/pimpinan', [PimpinanController::class, 'index'])->name('admin.pimpinan');
    Route::post('/admin/pimpinan', [PimpinanController::class, 'store'])->name('admin.pimpinan.store');
    Route::put('/admin/pimpinan/{pimpinan}', [PimpinanController::class, 'update'])->name('admin.pimpinan.update');
    Route::delete('/admin/pimpinan/{pimpinan}', [PimpinanController::class, 'destroy'])->name('admin.pimpinan.destroy');

    // Kelola Tenaga Pendidik (Guru)
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::put('/admin/guru/{guru}', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin/guru/{guru}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

    // Kelola Mitra Industri (DUDI)
    Route::get('/admin/dudi', [DudiController::class, 'index'])->name('admin.dudi');
    Route::post('/admin/dudi', [DudiController::class, 'store'])->name('admin.dudi.store');
    Route::put('/admin/dudi/{dudi}', [DudiController::class, 'update'])->name('admin.dudi.update');
    Route::delete('/admin/dudi/{dudi}', [DudiController::class, 'destroy'])->name('admin.dudi.destroy');
});

// ================= HALAMAN SUPER ADMIN & PENULIS BERITA =================
Route::middleware(['auth', 'role:admin,penulis'])->group(function () {
    // Kelola Berita / Blog
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
});