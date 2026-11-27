<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Dosen\{MahasiswaController, MataKuliahController, JadwalController, NilaiController, TagihanController};
use App\Http\Controllers\Mahasiswa\AkademikController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/biodata', 'biodata')->name('biodata');
    Route::get('/biodata/edit', [BiodataController::class, 'edit'])->name('biodata.edit');
    Route::put('/biodata', [BiodataController::class, 'update'])->name('biodata.update');
});

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    Route::get('matakuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::post('matakuliah', [MataKuliahController::class, 'store'])->name('matakuliah.store');

    Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::delete('jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::post('nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::post('nilai/peserta', [NilaiController::class, 'tambahPeserta'])->name('nilai.peserta.store');
    Route::delete('nilai/peserta/{mahasiswa}', [NilaiController::class, 'hapusPeserta'])->name('nilai.peserta.destroy');

    Route::get('tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::post('tagihan', [TagihanController::class, 'store'])->name('tagihan.store');
    Route::patch('tagihan/{tagihan}/lunas', [TagihanController::class, 'lunas'])->name('tagihan.lunas');
});

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('nilai', [AkademikController::class, 'nilai'])->name('nilai');
    Route::get('mata-kuliah', [AkademikController::class, 'matkul'])->name('matkul');
    Route::get('tagihan', [AkademikController::class, 'tagihan'])->name('tagihan');
});

require __DIR__.'/auth.php';