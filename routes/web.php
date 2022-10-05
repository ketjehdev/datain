<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Core\CoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// dashboard
Route::prefix('datain')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [CoreController::class, 'dashboard'])->name('dashboard');
    });
});

// authentication
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/datainLogin', [AuthController::class, 'login_handle'])->name('login_handle');
Route::post('/datainLogout', [AuthController::class, 'logout'])->name('logout');
