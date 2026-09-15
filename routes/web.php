<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman landing
Route::get('/landing', function () {
    return view('landing.landing');
})->name('landing');

// Route untuk membuat pengguna
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route untuk memilih nama
Route::get('/choose-name', [UserController::class, 'chooseName'])->name('users.choose');

// Route untuk tampilan input TJTA
Route::get('/input/{id}', [UserController::class, 'showForm'])->name('input.input');
Route::post('/lookup', [UserController::class, 'performLookup'])->name('input.lookup');