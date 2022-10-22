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

    Route::get('/capel', [CoreController::class, 'capel'])->name('capel');


    Route::get('/inpel', [CoreController::class, 'inpel'])->name('inpel')->middleware('access_role:teknisi');

    Route::group(['middleware' => 'access_role:admin'], function () {
        Route::get('/pain', [CoreController::class, 'pain'])->name('pain');
        Route::post('/tambahPaket', [CoreController::class, 'tambahPaket'])->name('tambahPaket');
        Route::post('/deletePaket/{id}', [CoreController::class, 'deletePaket'])->name('deletePaket');
        Route::post('/updatePaket/{id}', [CoreController::class, 'updatePaket'])->name('updatePaket');

        Route::get('/teknisiKaryawan', [CoreController::class, 'teknisiKaryawan'])->name('teknisiKaryawan');
        Route::post('/tambahTeknisi', [CoreController::class, 'tambahTeknisi'])->name('tambahTeknisi');
        Route::post('/hapusTeknisi/{id}', [CoreController::class, 'hapusTeknisi'])->name('hapusTeknisi');
        Route::post('/updateTeknisi/{id}', [CoreController::class, 'updateTeknisi'])->name('updateTeknisi');
    });


    Route::get('/editProfil', [CoreController::class, 'myProfil'])->name('editProfil');
    Route::get('/gantiPassword', [CoreController::class, 'gantiPassword'])->name('gantiPassword');
    Route::put('/updateProfil', [CoreController::class, 'updateProfil'])->name('updateProfil');
    Route::put('/updatePassword', [CoreController::class, 'updatePassword'])->name('updatePassword');
});
