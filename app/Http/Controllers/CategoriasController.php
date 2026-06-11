<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Categoria::with('cursos')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        $categoria = Categoria::create($data);

        return response()->json($categoria, 201);
    }

    public function show(Categoria $categoria): JsonResponse
    {
        return response()->json($categoria->load('cursos'));
    }

    public function update(Request $request, Categoria $categoria): JsonResponse
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id,
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        $categoria->update($data);

        return response()->json($categoria);
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        $categoria->delete();

        return response()->json(null, 204);
    }
}
