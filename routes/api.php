<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\CursosController;
use Illuminate\Support\Facades\Route;

// Autenticación (pública)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'registro']);

// Rutas públicas
Route::get('/cursos', [CursosController::class, 'index']);
Route::get('/cursos/{curso}', [CursosController::class, 'show']);
Route::get('/categorias', [CategoriasController::class, 'index']);
Route::get('/categorias/{categoria}', [CategoriasController::class, 'show']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD cursos (solo instructores autenticados pueden crear/editar/borrar)
    Route::post('/cursos', [CursosController::class, 'store']);
    Route::patch('/cursos/{curso}', [CursosController::class, 'update']);
    Route::delete('/cursos/{curso}', [CursosController::class, 'destroy']);

    // CRUD categorías
    Route::apiResource('categorias', CategoriasController::class)->except(['index', 'show']);

    // Citas
    Route::apiResource('citas', CitasController::class);
});
