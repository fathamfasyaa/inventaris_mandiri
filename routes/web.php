<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BarangInventarisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

// Route untuk login (tidak perlu autentikasi)
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('auth');

// Logout (harus login)
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Grup Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('jenis_barang', JenisBarangController::class);
    Route::get('/jenis-barang', [JenisBarangController::class, 'jnsindex'])->name('jenis_barang.index');
    Route::get('/jenis-barang/create', [JenisBarangController::class, 'jnscreate'])->name('jenis_barang.create');
    Route::post('/jenis-barang', [JenisBarangController::class, 'jnsstore'])->name('jenis_barang.store');
    Route::get('/jenis-barang/{jns_brg_kode}/edit', [JenisBarangController::class, 'jnsedit'])->name('jenis_barang.edit');
    Route::put('/jenis-barang/{jns_brg_kode}', [JenisBarangController::class, 'jnsupdate'])->name('jenis_barang.update');
    Route::delete('/jenis-barang/{jns_brg_kode}', [JenisBarangController::class, 'jnsdestroy'])->name('jenis_barang.destroy');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/barang-inventaris', [BarangInventarisController::class, 'index'])->name('barang_inventaris.index');
    Route::get('/barang-inventaris/create', [BarangInventarisController::class, 'create'])->name('barang_inventaris.create');
    Route::post('/barang-inventaris', [BarangInventarisController::class, 'store'])->name('barang_inventaris.store');
    Route::get('/barang-inventaris/{br_kode}/edit', [BarangInventarisController::class, 'edit'])->name('barang_inventaris.edit');
    Route::put('/barang-inventaris/{br_kode}/update', [BarangInventarisController::class, 'update'])->name('barang_inventaris.update');
    Route::delete('/barang-inventaris/{br_kode}/delete', [BarangInventarisController::class, 'destroy'])->name('barang_inventaris.destroy');

    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index'); // List pengembalian
    Route::get('pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create'); // Form pengembalian
    Route::post('pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store'); // Simpan pengembalian
    Route::get('pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show'); // Detail pengembalian

});
