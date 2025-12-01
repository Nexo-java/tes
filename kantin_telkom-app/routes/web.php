<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KantinController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TransaksiController;


use Illuminate\Support\Facades\Route;

// Penjelasan: Grup route untuk autentikasi user (login, logout)
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login'); // Menampilkan form login
    Route::post('/login', 'login')->name('login.process'); // Proses login
    Route::post('/logout', 'logout')->name('logout'); // Proses logout
});

// Penjelasan: Grup route untuk admin (dashboard, kelola kantin, menu, order, riwayat)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // Dashboard admin
    Route::get('dashboard/revenue-data', [AdminDashboardController::class, 'getRevenueData'])->name('dashboard.revenue'); // Data revenue

    Route::resource('kantin', KantinController::class); // CRUD kantin

    Route::resource('kantin.menus', MenuController::class); // CRUD menu di kantin

    Route::patch('kantin/{kantin}/menus/{menu}/toggle',
    [MenuController::class, 'toggle']
)->name('kantin.menus.toggle'); // Toggle status menu

    // Penjelasan: Route untuk order dan notifikasi admin
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index'); // List order
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show'); // Detail order
    Route::post('orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus'); // Update status order
    Route::post('orders/{id}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus'); // Update status pembayaran
    Route::post('orders/mark-all-read', [OrderController::class, 'markAllAsRead'])->name('orders.markAllRead'); // Tandai semua notifikasi order sudah dibaca

    // Penjelasan: Route untuk riwayat transaksi admin
    Route::get('riwayat', [RiwayatController::class, 'index'])->name('riwayat.index'); // List riwayat
    Route::delete('riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy'); // Hapus riwayat
    Route::post('riwayat/bulk-delete', [RiwayatController::class, 'bulkDelete'])->name('riwayat.bulkDelete'); // Hapus banyak riwayat sekaligus
    Route::post('riwayat/delete-all', [RiwayatController::class, 'deleteAll'])->name('riwayat.deleteAll'); // Hapus semua riwayat
});

// Penjelasan: Grup route untuk user (dashboard, canteen, profile, history, notifikasi, transaksi)
Route::prefix('user')->name('user.')->middleware('auth:pengguna')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard'); // Dashboard user
    Route::get('canteen/{id}', [UserDashboardController::class, 'canteen'])->name('canteen'); // Halaman kantin user
    Route::get('search', [UserDashboardController::class, 'search'])->name('search'); // Pencarian menu
    Route::get('profile', [ProfileController::class, 'index'])->name('profile'); // Profil user
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('editProfile'); // Edit profil user
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update'); // Update profil user
    Route::get('history', [TransaksiController::class, 'history'])->name('history'); // Riwayat transaksi user
    Route::delete('history/{id}', [TransaksiController::class, 'deleteHistory'])->name('history.delete'); // Hapus riwayat transaksi
    Route::get('notifications', [TransaksiController::class, 'getNotifications'])->name('notifications'); // Notifikasi user
    Route::post('notifications/mark-all-read', [TransaksiController::class, 'markAllRead'])->name('notifications.markAllRead'); // Tandai semua notifikasi sudah dibaca
    Route::delete('notifications/delete-all', [TransaksiController::class, 'deleteAll'])->name('notifications.deleteAll'); // Hapus semua notifikasi
    Route::post('/checkout', [TransaksiController::class, 'store'])->name('checkout.store'); // Proses checkout
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store'); // Proses transaksi
});

// Penjelasan: Route untuk mendapatkan CSRF token
Route::get('/token', function () {
    return csrf_token(); // Mengembalikan token CSRF
});


