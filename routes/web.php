<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;

use App\Http\Controllers\UlamAiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController as PublicReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

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
    $menus = Menu::where('status', 'tersedia')->get();
    $menusByCategory = $menus->groupBy('cat');

    return view('menu', compact('menusByCategory'));
});

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

Route::post('/reservasi', [PublicReservationController::class, 'store'])->name('reservasi.store');

Route::get('/reservasi/cek-ketersediaan', [PublicReservationController::class, 'cekKetersediaan'])->name('reservasi.cek');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

// Fitur Tanya Ulam AI
Route::get('/tanya-ai', [UlamAiController::class, 'index'])->name('ai.index');
Route::post('/tanya-ai/chat', [UlamAiController::class, 'chat'])->name('ai.chat');


// ==========================================
// ROUTE PANEL ADMIN
// ==========================================

Route::prefix('admin')->group(function () {

    // Bisa diakses tanpa login (proses login & halaman yang menampilkan layar login)
    Route::post('/api/login', [DashboardController::class, 'login']);
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Wajib login
    Route::middleware('auth')->group(function () {

        Route::post('/api/logout', [DashboardController::class, 'logout']);
        Route::get('/api/reservations', [AdminReservationController::class, 'index']);

        // Menu
        Route::post('/api/menus', [DashboardController::class, 'storeMenu']);
        Route::put('/api/menus/{id}', [DashboardController::class, 'updateMenu']);
        Route::delete('/api/menus/{id}', [DashboardController::class, 'destroyMenu']);
        Route::patch('/api/menus/{id}/toggle', [DashboardController::class, 'toggleMenuStatus']);

        // Reservasi & pembayaran
        Route::put('/api/reservations/{id}/status', [DashboardController::class, 'updateReservationStatus']);
        Route::post('/api/payments/{id}/verify', [DashboardController::class, 'verifyPayment']);

        // Bukti transfer (hanya bisa dilihat admin yang login)
        // Alamat akhir: /admin/bukti/{path}
        Route::get('/bukti/{path}', function (string $path) {

            // Buang awalan "storage/" kalau ada
            $path = ltrim(preg_replace('#^/?storage/#', '', $path), '/');

            // Hanya boleh membaca dari dua folder ini
            $storageBase = realpath(storage_path('app/public'));
            $uploadBase  = realpath(public_path('uploads'));

            $candidates = [storage_path('app/public/' . $path)];

            if (str_starts_with($path, 'uploads/')) {
                $candidates[] = public_path($path);
            }

            foreach ($candidates as $file) {
                $real = realpath($file);

                if (!$real || !is_file($real)) {
                    continue;
                }

                $aman = ($storageBase && str_starts_with($real, $storageBase))
                     || ($uploadBase && str_starts_with($real, $uploadBase));

                if ($aman) {
                    return response()->file($real);
                }
            }

            abort(404);
        })->where('path', '.*');

    });

});