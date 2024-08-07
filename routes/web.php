<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/hash-password', function (Request $request) {
    $password = $request->query('password', 'P@ssw0rd');
    $hashedPassword = Hash::make($password);

    return $hashedPassword;
});

// ======MIDDLEWARE======
Route::middleware(['role'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('data-nasabah', [NasabahController::class, 'index'])->name('data-nasabah');
    Route::get('data-nasabah/{nasabah}', [NasabahController::class, 'show'])->name('form-nasabah.detail');
    Route::get('data-nasabah/{nasabah}/verified', [NasabahController::class, 'verified'])->name('data-nasabah.verified');

    # Registration Nasabah
    Route::get('form-nasabah', [NasabahController::class, 'create'])->name('form-nasabah');
    Route::post('form-nasabah/store', [NasabahController::class, 'store'])->name('form-nasabah.store');

    # Peminjaman
    Route::get('form-peminjaman', [PeminjamanController::class, 'create'])->name('form-peminjaman');
    Route::post('form-peminjaman/store', [PeminjamanController::class, 'store'])->name('form-peminjaman.store');

    # Daftar Peminjaman
    Route::get('validate-peminjaman',[PeminjamanController::class, 'validatePeminjaman'])->name('validate-peminjaman');
    Route::get('validate-peminjaman/{id}/edit',[PeminjamanController::class, 'edit'])->name('validate-peminjaman.edit');
    Route::put('validate-peminjaman/{id}',[PeminjamanController::class, 'update'])->name('validate-peminjaman.update');

    // Pembayaran nasabah

    Route::get('data-pembayaran',[PembayaranController::class, 'index'])->name('data-pembayaran');
    Route::post('pembayaran/{id}/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('pembayaran/{id}/show', [PembayaranController::class, 'show'])->name('pembayaran.show');

    // Pembayaran Admin VALIDASI
    Route::get('validate-data-pembayaran',[PembayaranController::class, 'validatePembayaran'])->name('validate-pembayaran');
    Route::put('validate-pembayaran/{id}', [PembayaranController::class, 'update'])->name('validate-data-pembayaran.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';





