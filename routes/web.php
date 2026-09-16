<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/landing');

// Route untuk halaman landing
Route::get('/landing', function () {
    return view('landing.landing');
})->name('landing');

// Route untuk membuat pengguna
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route untuk memilih nama
Route::get('/choose-name', [UserController::class, 'chooseName'])->name('users.choose');

// Route untuk tampilan input TJTA
Route::get('/input/{id}', [UserController::class, 'showForm'])->name('input.input');
Route::post('/lookup', [UserController::class, 'performLookup'])->name('input.lookup');

// Route untuk mengelola riwayat hasil
Route::get('/results/{id}/edit', [UserController::class, 'editResult'])->name('results.edit');
Route::put('/results/{id}', [UserController::class, 'updateResult'])->name('results.update');
Route::delete('/results/{id}', [UserController::class, 'destroyResult'])->name('results.destroy');

// Route laporan PDF TJTA
Route::get('/reports/sample', [ReportController::class, 'sample'])->name('reports.sample');
Route::get('/reports/users/{id}', [ReportController::class, 'download'])->name('reports.user');
