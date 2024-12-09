<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\IncidenciaController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/zonas', [ZonaController::class, 'index']);
    Route::get('/propiedades', [PropiedadController::class, 'index']);
    Route::post('/incidencias', [IncidenciaController::class, 'store']);
});
