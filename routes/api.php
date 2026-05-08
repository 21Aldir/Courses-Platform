/<?php

use App\Http\Controllers\CitasController;
use Illuminate\Support\Facades\Route;

// Cursos
Route::get('/cursos', function () {
    return response()->json(['message' => 'Listado de cursos']);
});

Route::get('/cursos/{curso}', function ($curso) {
    return response()->json(['message' => 'Detalle del curso', 'curso' => $curso]);
});

// Categorías
Route::get('/categorias', function () {
    return response()->json(['message' => 'Listado de categorías']);
});

Route::get('/categorias/{categoria}', function ($categoria) {
    return response()->json(['message' => 'Cursos de la categoría', 'categoria' => $categoria]);
})->whereAlpha('categoria');

// Autenticación
Route::post('/login', function () {
    return response()->json(['message' => 'Inicio de sesión procesado']);
});

Route::post('/logout', function () {
    return response()->json(['message' => 'Sesión cerrada']);
});

Route::post('/registro', function () {
    return response()->json(['message' => 'Cuenta creada exitosamente']);
});

// Inscripciones
Route::get('/mis-cursos', function () {
    return response()->json(['message' => 'Cursos en los que estoy inscrito']);
});

Route::post('/cursos/{curso}/inscripcion', function ($curso) {
    return response()->json(['message' => 'Inscripción al curso', 'curso' => $curso]);
});

Route::delete('/cursos/{curso}/inscripcion', function ($curso) {
    return response()->json(['message' => 'Inscripción cancelada', 'curso' => $curso]);
});

// Instructor
Route::get('/instructor/cursos', function () {
    return response()->json(['message' => 'Mis cursos como instructor']);
});

Route::post('/instructor/cursos', function () {
    return response()->json(['message' => 'Curso creado'], 201);
});

Route::patch('/instructor/cursos/{curso}', function ($curso) {
    return response()->json(['message' => 'Curso actualizado', 'curso' => $curso]);
});

Route::delete('/instructor/cursos/{curso}', function ($curso) {
    return response()->json(['message' => 'Curso eliminado', 'curso' => $curso]);
});

// Perfil
Route::get('/perfil/{usuario}', function ($usuario) {
    return response()->json(['message' => 'Perfil del usuario', 'usuario' => $usuario]);
})->whereAlphaNumeric('usuario');

Route::patch('/perfil/{usuario}', function ($usuario) {
    return response()->json(['message' => 'Perfil actualizado', 'usuario' => $usuario]);
});

// Citas (Resource Controller)
Route::apiResource('citas', CitasController::class);
