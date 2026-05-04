<?php

use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────
// Página principal
// ─────────────────────────────────────────

Route::get('/', function () {
    return view('welcome');
});

// ─────────────────────────────────────────
// Catálogo de cursos
// ─────────────────────────────────────────

Route::get('/cursos', function () {
    return 'Mostrar catálogo de cursos';
});

Route::get('/cursos/{curso}', function ($curso) {
    return 'Ver detalle del curso: ' . $curso;
});

// ─────────────────────────────────────────
// Categorías
// ─────────────────────────────────────────

Route::get('/categorias', function () {
    return 'Mostrar todas las categorías';
});

Route::get('/categorias/{categoria}', function ($categoria) {
    return 'Cursos de la categoría: ' . $categoria;
})->whereAlpha('categoria');

// ─────────────────────────────────────────
// Autenticación
// ─────────────────────────────────────────

Route::get('/login', function () {
    return 'Formulario de inicio de sesión';
});

Route::post('/login', function () {
    return 'Procesar inicio de sesión';
});

Route::post('/logout', function () {
    return 'Cerrar sesión';
});

Route::get('/registro', function () {
    return 'Formulario de registro (alumno o instructor)';
});

Route::post('/registro', function () {
    return 'Crear nueva cuenta';
});

// ─────────────────────────────────────────
// Inscripciones (alumno)
// ─────────────────────────────────────────

Route::get('/mis-cursos', function () {
    return 'Mostrar cursos en los que estoy inscrito';
});

Route::post('/cursos/{curso}/inscripcion', function ($curso) {
    return 'Inscribirse al curso: ' . $curso;
});

Route::delete('/cursos/{curso}/inscripcion', function ($curso) {
    return 'Cancelar inscripción al curso: ' . $curso;
});

// ─────────────────────────────────────────
// Panel del instructor
// ─────────────────────────────────────────

Route::get('/instructor/dashboard', function () {
    return 'Panel del instructor — resumen de cursos e inscritos';
});

Route::get('/instructor/cursos', function () {
    return 'Mostrar mis cursos como instructor';
});

Route::get('/instructor/cursos/create', function () {
    return 'Formulario para crear un nuevo curso';
});

Route::post('/instructor/cursos', function () {
    return 'Guardar nuevo curso';
});

Route::get('/instructor/cursos/{curso}/edit', function ($curso) {
    return 'Formulario para editar el curso: ' . $curso;
});

Route::patch('/instructor/cursos/{curso}', function ($curso) {
    return 'Actualizar datos del curso: ' . $curso;
});

Route::delete('/instructor/cursos/{curso}', function ($curso) {
    return 'Eliminar el curso: ' . $curso;
});

// ─────────────────────────────────────────
// Perfil de usuario
// ─────────────────────────────────────────

Route::get('/perfil/{usuario}', function ($usuario) {
    return 'Ver perfil del usuario: ' . $usuario;
})->whereAlphaNumeric('usuario');

Route::patch('/perfil/{usuario}', function ($usuario) {
    return 'Actualizar perfil del usuario: ' . $usuario;
});
