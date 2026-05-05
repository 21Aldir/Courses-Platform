<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {
        return 'Mostrar lista de citas desde el controlador';
    }

    public function create()
    {
        return 'Mostrar formulario para crear una cita';
    }

    public function store(Request $request)
    {
        return 'Guardar una nueva cita';
    }

    public function show(string $id)
    {
        return 'Mostrar la cita con ID: ' . $id;
    }

    public function edit(string $id)
    {
        return 'Mostrar formulario para editar la cita con ID: ' . $id;
    }

    public function update(Request $request, string $id)
    {
        return 'Actualizar la cita con ID: ' . $id;
    }

    public function destroy(string $id)
    {
        return 'Eliminar la cita con ID: ' . $id;
    }
}
