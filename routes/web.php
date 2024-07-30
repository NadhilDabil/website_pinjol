<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ValidateUserRoleMiddleware;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('dashboard', [HomeController::class,'index'])->middleware('auth');

// Route::get('form-data_diri', [HomeController::class, 'form'])->middleware('auth');


Route::get('form-nasabah/{id}', [NasabahController::class, 'create'])->name('form-nasabah');

Route::post('form-nasabah/{id}/store', [NasabahController::class, 'store'])->name('form-nasabah.store');

// ======MIDDLEWARE UNNTUK NASABAH======
Route::middleware(['role'])->group(function () {
    
    Route::get('dashboard', [HomeController::class,'index']);

    Route::get('data-nasabah', [NasabahController::class, 'index'])->name('data-nasabah');

});


// =====MIDDLEWARE UNTUK ADMIN=====
Route::middleware(['role:admin'])->group(function () {

});







