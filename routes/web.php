<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UlamAiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Models\Menu;

Route::get('/menu', function () {
    $menusByCategory = Menu::where('status', 'tersedia')
        ->orderBy('name')
        ->get()
        ->groupBy('cat');

    return view('menu', compact('menusByCategory'));
});

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

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');

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

    Route::post('/api/login', [DashboardController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::patch('/api/menus/{id}/toggle', [DashboardController::class, 'toggleMenuStatus']);

        Route::get('/', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::post('/api/logout', [DashboardController::class, 'logout']);

        Route::post('/api/menus', [DashboardController::class, 'storeMenu']);

        Route::put('/api/menus/{id}', [DashboardController::class, 'updateMenu']);

        Route::delete('/api/menus/{id}', [DashboardController::class, 'destroyMenu']);

        Route::put(
            '/api/reservations/{id}/status',
            [DashboardController::class, 'updateReservationStatus']
        );
    });


});