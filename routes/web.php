<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\RencanaController;
use App\Http\Controllers\DipaController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\KancilController;


Route::get('/', [KancilController::class, 'index']);
Route::get('/', [KancilController::class, 'index'])->name('kancil.index');


Route::get('/tes-img', function () {
    return response()->file(storage_path('app/public/imigrasi.jpg'));
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/realisasis', \App\Http\Controllers\RealisasiController::class);
Route::resource('/rencanas', \App\Http\Controllers\RencanaController::class);
Route::resource('/dipas', \App\Http\Controllers\DipaController::class);

