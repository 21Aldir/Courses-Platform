@extends('layouts.app')

@section('title', 'Instructor Dashboard — Udemy v2')

@section('content')

  <section id="instructor-section">
    <div class="instructor-header">
      <h2>Instructor Dashboard</h2>
      <p>Hola, <strong>{{ auth()->user()->name }}</strong> — estos son los cursos que te han asignado</p>
    </div>

    {{-- Mis cursos asignados --}}
    <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:16px;color:#111827;">📚 Mis cursos</h3>

    @if($misCursos->isEmpty())
      <div style="text-align:center;padding:48px 0;margin-bottom:40px;background:#fff;border-radius:12px;border:1px solid #e5e7eb;">
        <p style="color:#6b7280;font-size:1rem;">Aún no tienes cursos asignados.</p>
        <p style="color:#9ca3af;font-size:0.875rem;margin-top:8px;">El administrador te asignará cursos próximamente.</p>
      </div>
    @else
      <div id="instructor-courses" style="margin-bottom:40px;">
        <table>
          <thead>
            <tr>
              <th>Curso</th>
              <th>Categoría</th>
              <th>Nivel</th>
              <th>Inscritos</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($misCursos as $curso)
              <tr>
                <td>{{ $curso->titulo }}</td>
                <td>{{ $curso->categoria->nombre ?? '—' }}</td>
                <td>{{ $curso->nivel }}</td>
                <td>{{ $curso->inscripciones_count }} / {{ $curso->cupos }}</td>
                <td>
                  @if($curso->status === 'approved')
                    <span class="badge badge-available">Approved</span>
                  @elseif($curso->status === 'rejected')
                    <span class="badge badge-full">Rejected</span>
                  @else
                    <span class="badge" style="background:#fef3c7;color:#d97706;">Pending</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">Total inscritos</td>
              <td>{{ $misCursos->sum('inscripciones_count') }}</td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    @endif

    {{-- Catálogo disponible --}}
    <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:16px;color:#111827;">🌐 Cursos disponibles</h3>

    @if($catalogo->isEmpty())
      <p style="color:#6b7280;">No hay cursos aprobados todavía.</p>
    @else
      <div id="courses-grid">
        @foreach($catalogo as $curso)
          <article class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span class="badge badge-category">{{ $curso->categoria->nombre ?? 'General' }}</span>
              @if($curso->instructor_id === auth()->id())
                <span class="badge" style="background:#e0e7ff;color:#4338ca;">Tuyo</span>
              @endif
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
          </article>
        @endforeach
      </div>
    @endif

  </section>

@endsection
