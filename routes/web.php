<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaSertifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Khusus Admin: kelola user & skema
    Route::middleware('role:admin')->group(function () {
        Route::resource('peserta', PesertaController::class)
            ->only(['index', 'show', 'edit', 'update', 'destroy'])
            ->parameters(['peserta' => 'user']);

        Route::resource('skema', SkemaSertifikasiController::class)
            ->parameters(['skema' => 'skema']);
    });

    // Khusus User: edit data sendiri
    Route::middleware('role:user')
        ->prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/profil', [DashboardController::class, 'editProfil'])->name('profil.edit');
            Route::put('/profil', [DashboardController::class, 'updateProfil'])->name('profil.update');
        });
});