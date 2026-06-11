<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Cita::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'estudiante' => 'required|string',
            'materia'    => 'required|string',
            'fecha'      => 'required|date',
            'tutor'      => 'required|string',
            'contacto'   => 'required|string',
        ]);

        $cita = Cita::create($data);

        return response()->json($cita, 201);
    }

    public function show(Cita $cita): JsonResponse
    {
        return response()->json($cita);
    }

    public function update(Request $request, Cita $cita): JsonResponse
    {
        $data = $request->validate([
            'estudiante' => 'sometimes|string',
            'materia'    => 'sometimes|string',
            'fecha'      => 'sometimes|date',
            'tutor'      => 'sometimes|string',
            'contacto'   => 'sometimes|string',
        ]);

        $cita->update($data);

        return response()->json($cita);
    }

    public function destroy(Cita $cita): JsonResponse
    {
        $cita->delete();

        return response()->json(null, 204);
    }
}
