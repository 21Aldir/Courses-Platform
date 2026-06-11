@extends('layouts.app')

@section('title', 'Admin Dashboard — Udemy v2')

@section('content')

  <section id="instructor-section">
    <div class="instructor-header">
      <h2>Admin Dashboard</h2>
      <p>Hola, <strong>{{ auth()->user()->name }}</strong> — gestiona usuarios y cursos</p>
    </div>

    {{-- Cursos pendientes --}}
    <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:16px;color:#111827;">
      ⏳ Cursos pendientes de aprobación
      <span style="background:#fef3c7;color:#d97706;padding:2px 10px;border-radius:20px;font-size:0.8rem;margin-left:8px;">{{ $pendientes->count() }}</span>
    </h3>

    @if($pendientes->isEmpty())
      <p style="color:#6b7280;margin-bottom:32px;">No hay cursos pendientes.</p>
    @else
      <div id="instructor-courses" style="margin-bottom:40px;">
        <table>
          <thead>
            <tr>
              <th>Curso</th><th>Instructor</th><th>Categoría</th><th>Nivel</th><th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pendientes as $curso)
              <tr>
                <td>{{ $curso->titulo }}</td>
                <td>{{ $curso->instructor->name ?? 'Sin instructor' }}</td>
                <td>{{ $curso->categoria->nombre ?? '—' }}</td>
                <td>{{ $curso->nivel }}</td>
                <td style="display:flex;gap:8px;">
                  <form action="/admin/cursos/{{ $curso->id }}/approve" method="POST">
                    @csrf
                    <button class="btn btn-primary" style="padding:6px 12px;font-size:0.8rem;background:#16a34a;">✓ Approve</button>
                  </form>
                  <form action="/admin/cursos/{{ $curso->id }}/reject" method="POST">
                    @csrf
                    <button class="btn" style="background:#ef4444;color:#fff;padding:6px 12px;font-size:0.8rem;">✗ Reject</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    {{-- Todos los cursos --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
      <h3 style="font-size:1.1rem;font-weight:700;color:#111827;">📚 Todos los cursos</h3>
      <a href="/admin/cursos/create" class="btn btn-primary" style="font-size:0.85rem;padding:8px 16px;">+ New Course</a>
    </div>
    <div id="instructor-courses" style="margin-bottom:40px;">
      <table>
        <thead>
          <tr><th>Curso</th><th>Instructor</th><th>Categoría</th><th>Status</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          @foreach($cursos as $curso)
            <tr>
              <td>{{ $curso->titulo }}</td>
              <td>{{ $curso->instructor->name ?? 'Sin instructor' }}</td>
              <td>{{ $curso->categoria->nombre ?? '—' }}</td>
              <td>
                @if($curso->status === 'approved')
                  <span class="badge badge-available">Approved</span>
                @elseif($curso->status === 'rejected')
                  <span class="badge badge-full">Rejected</span>
                @else
                  <span class="badge" style="background:#fef3c7;color:#d97706;">Pending</span>
                @endif
              </td>
              <td style="display:flex;gap:8px;">
                <a href="/admin/cursos/{{ $curso->id }}/edit" class="btn btn-secondary" style="padding:6px 12px;font-size:0.8rem;">Edit</a>
                <form action="/admin/cursos/{{ $curso->id }}" method="POST">
                  @csrf @method('DELETE')
                  <button class="btn" style="background:#ef4444;color:#fff;padding:6px 12px;font-size:0.8rem;"
                    onclick="return confirm('¿Eliminar este curso?')">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Usuarios --}}
    <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:16px;color:#111827;">👥 Usuarios</h3>
    <div id="instructor-courses">
      <table>
        <thead>
          <tr><th>Nombre</th><th>Email</th><th>Rol</th><th>Registrado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          @foreach($usuarios as $u)
            <tr>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>
                <span class="badge badge-category">{{ $u->role }}</span>
              </td>
              <td>{{ $u->created_at->format('d/m/Y') }}</td>
              <td style="display:flex;gap:8px;">
                <a href="/admin/usuarios/{{ $u->id }}/edit" class="btn btn-secondary" style="padding:6px 12px;font-size:0.8rem;">Edit</a>
                @if($u->id !== auth()->id())
                  <form action="/admin/usuarios/{{ $u->id }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn" style="background:#ef4444;color:#fff;padding:6px 12px;font-size:0.8rem;"
                      onclick="return confirm('¿Eliminar usuario?')">Delete</button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr><td colspan="2">Total usuarios</td><td>{{ $usuarios->count() }}</td><td colspan="2"></td></tr>
        </tfoot>
      </table>
    </div>

  </section>

@endsection
