<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('zonas', ZonaController::class);
    Route::resource('propiedades', PropiedadController::class);
    Route::resource('users', UserController::class);
    Route::resource('guardias', GuardiaController::class);
    Route::resource('residentes', ResidenteController::class);
    Route::resource('horarios', HorarioController::class);
    Route::resource('incidencias', IncidenciaController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
