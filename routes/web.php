<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Halaman Utama / Beranda
Route::get('/', function () {
    return view('welcome');
});

// Halaman Menu
Route::get('/menu', function () {
    return view('menu');
});

// Halaman Reservasi
Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

// Proses Simpan Form Reservasi
Route::post('/reservasi', function (Request $request) {
    $validated = $request->validate([
        'nama_lengkap'   => 'required|string|max:255',
        'nomor_whatsapp' => 'required|numeric',
        'tanggal_acara'  => 'required|date',
        'jumlah_peserta' => 'required|integer|min:10',
        'catatan'        => 'nullable|string',
    ]);

    return back()->with('success', 'Reservasi berhasil dikirim!');
})->name('reservasi.store');
Route::get('/tentang-kami', function () {
    return view('tentang-kami'); // Pastikan nama file Blade Anda adalah tentang-kami.blade.php
});
use App\Http\Controllers\UlamAiController;

// Halaman Chat UI
Route::get('/tanya-ai', [UlamAiController::class, 'index'])->name('ai.index');

// Endpoint AJAX untuk kirim pesan
Route::post('/tanya-ai/chat', [UlamAiController::class, 'chat'])->name('ai.chat');
use App\Http\Controllers\AiController; // Sesuaikan dengan controller Anda jika ada

Route::get('/ulam-ai', function () {
    return view('ulam-ai'); // Pastikan Anda memiliki file resource/views/ulam-ai.blade.php
});