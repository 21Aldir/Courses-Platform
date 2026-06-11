@extends('layouts.app')

@section('title', 'Cursos — CoursesApp')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Todos los cursos</h1>
</div>

@if($cursos->isEmpty())
    <p class="text-gray-500">No hay cursos disponibles todavía.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cursos as $curso)
            <a href="/cursos/{{ $curso->id }}" class="bg-white rounded-xl shadow hover:shadow-md transition p-5 block">
                <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded font-medium">
                    {{ $curso->categoria->nombre ?? 'Sin categoría' }}
                </span>
                <h2 class="font-bold text-lg mt-3 mb-1">{{ $curso->titulo }}</h2>
                <p class="text-gray-500 text-sm">{{ Str::limit($curso->descripcion, 90) }}</p>
                <div class="mt-4 flex gap-3 text-xs text-gray-400">
                    <span>⏱ {{ $curso->duracion }}</span>
                    <span>🎯 {{ $curso->nivel }}</span>
                    <span>👥 {{ $curso->cupos }} cupos</span>
                </div>
                <p class="text-xs text-gray-400 mt-2">Instructor: {{ $curso->instructor->name ?? '—' }}</p>
            </a>
        @endforeach
    </div>
@endif

@endsection
