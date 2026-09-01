<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UlamAiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;

// ==========================================
// ROUTE AUTENTIKASI (LOGIN & LOGOUT)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==========================================
// ROUTE HALAMAN PUBLIK
// ==========================================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

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
    return view('tentang-kami');
});

// Fitur Tanya Ulam AI
Route::get('/tanya-ai', [UlamAiController::class, 'index'])->name('ai.index');
Route::post('/tanya-ai/chat', [UlamAiController::class, 'chat'])->name('ai.chat');


// ==========================================
// ROUTE PANEL ADMIN (Protected by Auth)
// ==========================================

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // API Routes for Admin SPA
    Route::post('/api/login', [DashboardController::class, 'login']);
    Route::post('/api/logout', [DashboardController::class, 'logout']);
    Route::post('/api/menus', [DashboardController::class, 'storeMenu']);
    Route::put('/api/menus/{id}', [DashboardController::class, 'updateMenu']);
    Route::delete('/api/menus/{id}', [DashboardController::class, 'destroyMenu']);
    Route::put('/api/reservations/{id}/status', [DashboardController::class, 'updateReservationStatus']);
});
