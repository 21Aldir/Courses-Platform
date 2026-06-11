@extends('layouts.app')

@section('title', 'My Courses — Udemy v2')

@section('content')

  <section id="instructor-section">
    <div class="instructor-header">
      <h2>My Courses</h2>
      <p>Hola, <strong>{{ auth()->user()->name }}</strong> — estos son los cursos en los que estás inscrito</p>
    </div>

    @if($cursos->isEmpty())
      <div style="text-align:center;padding:64px 0;">
        <p style="color:#6b7280;font-size:1rem;margin-bottom:20px;">Aún no estás inscrito en ningún curso.</p>
        <a href="/" class="btn btn-primary">Explorar cursos</a>
      </div>
    @else
      <div id="courses-grid">
        @foreach($cursos as $curso)
          <article class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span class="badge badge-category">{{ $curso->categoria->nombre ?? 'General' }}</span>
              <span class="badge badge-available">Enrolled</span>
            </div>
            <h3>{{ $curso->titulo }}</h3>
            <p><i>by {{ $curso->instructor->name ?? 'Sin instructor' }}</i></p>
            <small>{{ $curso->descripcion ?? '' }}</small>
            <hr>
            <div class="card-meta">
              <span>⏱ {{ $curso->duracion }}</span>
              <span>📶 {{ $curso->nivel }}</span>
              <span>👥 {{ $curso->inscripciones_count }}/{{ $curso->cupos }}</span>
            </div>
            <div style="display:flex;gap:8px;margin-top:auto;">
              <a href="/cursos/{{ $curso->id }}/inscripcion/pdf"
                class="btn btn-secondary"
                style="flex:1;text-align:center;text-decoration:none;">
                📄 Descargar PDF
              </a>
              <form action="/cursos/{{ $curso->id }}/inscripcion" method="POST" style="flex:1;">
                @csrf @method('DELETE')
                <button class="btn" style="width:100%;background:#fff;color:#ef4444;border:1px solid #ef4444;"
                  onclick="return confirm('¿Cancelar inscripción?')">Unenroll</button>
              </form>
            </div>
          </article>
        @endforeach
      </div>

      <div style="margin-top:32px;text-align:center;">
        <a href="/" class="btn btn-secondary">Ver más cursos</a>
      </div>
    @endif
  </section>

@endsection
