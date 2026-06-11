@extends('layouts.app')

@section('title', 'New Course — Admin')

@section('content')

  <div style="max-width:900px;margin:48px auto;padding:0 24px;">

    <h2 style="font-size:1.75rem;font-weight:700;margin-bottom:6px;">Create new course</h2>
    <p style="color:#6b7280;margin-bottom:32px;"><a href="/admin/dashboard" style="color:#5C4EE5;text-decoration:none;">← Back to dashboard</a></p>

    @if($errors->any())
      <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:24px;color:#dc2626;">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="/admin/cursos" method="POST">
      @csrf

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;">

        {{-- Columna izquierda: campos de texto --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
          <h3 style="font-size:0.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#9ca3af;margin-bottom:4px;">Información del curso</h3>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Course title</label>
            <input type="text" name="titulo" placeholder="e.g. Advanced React Patterns"
              value="{{ old('titulo') }}"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Description</label>
            <textarea name="descripcion" rows="4" placeholder="What will students learn?"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;resize:vertical;">{{ old('descripcion') }}</textarea>
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Duration</label>
            <input type="text" name="duracion" placeholder="e.g. 6 weeks"
              value="{{ old('duracion') }}"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Available spots</label>
            <input type="number" name="cupos" min="1" placeholder="e.g. 50"
              value="{{ old('cupos') }}"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
          </div>
        </div>

        {{-- Columna derecha: selects --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
          <h3 style="font-size:0.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#9ca3af;margin-bottom:4px;">Configuración</h3>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Category</label>
            <select name="categoria_id"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
              <option value="">Select a category</option>
              @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">
              Instructor <small style="color:#9ca3af;font-weight:400;">(opcional)</small>
            </label>
            <select name="instructor_id"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
              <option value="">Sin instructor</option>
              @foreach($instructores as $inst)
                <option value="{{ $inst->id }}" {{ old('instructor_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Level</label>
            <select name="nivel"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
              @foreach(['Beginner','Intermediate','Advanced'] as $lvl)
                <option value="{{ $lvl }}" {{ old('nivel') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="display:block;font-size:0.9rem;font-weight:600;color:#374151;margin-bottom:6px;">Status</label>
            <select name="status"
              style="width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;box-sizing:border-box;">
              <option value="approved" selected>✓ Approved</option>
              <option value="pending">⏳ Pending</option>
              <option value="rejected">✗ Rejected</option>
            </select>
          </div>

        </div>
      </div>

      {{-- Botones --}}
      <div style="display:flex;gap:12px;margin-top:32px;padding-top:24px;border-top:1px solid #e5e7eb;">
        <button type="submit" class="btn btn-primary">Create course</button>
        <a href="/admin/dashboard" class="btn btn-secondary" style="text-decoration:none;text-align:center;">Cancel</a>
      </div>

    </form>
  </div>

@endsection
