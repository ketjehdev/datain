<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Core\CoreController;
use Illuminate\Support\Facades\Route;


// auth
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/datainLogin', [AuthController::class, 'login_handle'])->name('login_handle');
Route::post('/datainLogout', [AuthController::class, 'logout'])->name('logout');

// core
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CoreController::class, 'dashboard'])->name('dashboard');
    Route::get('/teknisiKaryawan', [CoreController::class, 'teknisiKaryawan'])->name('teknisiKaryawan');
    Route::get('/vapel', [CoreController::class, 'vapel'])->name('vapel');
    Route::get('/editProfil', [CoreController::class, 'myProfil'])->name('editProfil');
    Route::get('/gantiPassword', [CoreController::class, 'gantiPassword'])->name('gantiPassword');
    Route::put('/updateProfil', [CoreController::class, 'updateProfil'])->name('updateProfil');
    Route::put('/updatePassword', [CoreController::class, 'updatePassword'])->name('updatePassword');
});
