<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CursosController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Curso::with('categoria', 'instructor')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'titulo'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'nivel'        => 'required|in:Beginner,Intermediate,Advanced',
            'duracion'     => 'required|string|max:50',
            'cupos'        => 'required|integer|min:1',
        ]);

        $data['instructor_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['titulo']);

        $curso = Curso::create($data);

        return response()->json($curso->load('categoria', 'instructor'), 201);
    }

    public function show(Curso $curso): JsonResponse
    {
        return response()->json($curso->load('categoria', 'instructor', 'inscripciones'));
    }

    public function update(Request $request, Curso $curso): JsonResponse
    {
        $data = $request->validate([
            'categoria_id' => 'sometimes|exists:categorias,id',
            'titulo'       => 'sometimes|string|max:255',
            'descripcion'  => 'sometimes|nullable|string',
            'nivel'        => 'sometimes|in:Beginner,Intermediate,Advanced',
            'duracion'     => 'sometimes|string|max:50',
            'cupos'        => 'sometimes|integer|min:1',
        ]);

        if (isset($data['titulo'])) {
            $data['slug'] = Str::slug($data['titulo']);
        }

        $curso->update($data);

        return response()->json($curso->load('categoria', 'instructor'));
    }

    public function destroy(Curso $curso): JsonResponse
    {
        $curso->delete();

        return response()->json(null, 204);
    }
}
