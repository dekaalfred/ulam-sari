<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;

use App\Http\Controllers\UlamAiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController as PublicReservationController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

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

    $menus = Menu::where('status', 'tersedia')->get();

    $menusByCategory = $menus->groupBy('cat');

    return view('menu', compact('menusByCategory'));

});

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

Route::post('/reservasi', [
    PublicReservationController::class,
    'store'
])->name('reservasi.store');

Route::get('/reservasi/cek-ketersediaan', [
    PublicReservationController::class,
    'cekKetersediaan'
])->name('reservasi.cek');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

// Fitur Tanya Ulam AI
Route::get('/tanya-ai', [UlamAiController::class, 'index'])->name('ai.index');
Route::post('/tanya-ai/chat', [UlamAiController::class, 'chat'])->name('ai.chat');

// ==========================================
// ROUTE PANEL ADMIN
// ==========================================

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [
            DashboardController::class,
            'index'
        ])->name('dashboard');

        Route::patch('/menus/{id}/toggle-status', [
            MenuController::class,
            'toggleStatus'
        ])->name('menus.toggle-status');

        Route::resource('/menus', MenuController::class);

        Route::resource(
            '/reservations',
            AdminReservationController::class
        );

    });
    