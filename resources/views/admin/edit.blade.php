@extends('layouts.app')

@section('title', 'Edit Course — Admin')

@section('content')

  <section id="login-section">
    <h2>Edit course <span style="color:#5C4EE5">{{ $curso->titulo }}</span></h2>
    <p><a href="/admin/dashboard">← Back to dashboard</a></p>

    <div class="card login-card">

      @if($errors->any())
        <p><span style="color:red">{{ $errors->first() }}</span></p>
      @endif

      <form action="/admin/cursos/{{ $curso->id }}" method="POST">
        @csrf @method('PATCH')

        <label for="instructor_id">Instructor <small style="color:#9ca3af">(opcional)</small></label>
        <select id="instructor_id" name="instructor_id" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          <option value="">Sin instructor</option>
          @foreach($instructores as $inst)
            <option value="{{ $inst->id }}" {{ old('instructor_id', $curso->instructor_id) == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
          @endforeach
        </select>

        <label for="titulo">Course title</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $curso->titulo) }}">

        <label for="categoria_id">Category</label>
        <select id="categoria_id" name="categoria_id" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          @foreach($categorias as $cat)
            <option value="{{ $cat->id }}" {{ old('categoria_id', $curso->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
          @endforeach
        </select>

        <label for="descripcion">Description</label>
        <textarea id="descripcion" name="descripcion" rows="3" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">{{ old('descripcion', $curso->descripcion) }}</textarea>

        <label for="nivel">Level</label>
        <select id="nivel" name="nivel" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          @foreach(['Beginner','Intermediate','Advanced'] as $lvl)
            <option value="{{ $lvl }}" {{ old('nivel', $curso->nivel) == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
          @endforeach
        </select>

        <label for="duracion">Duration</label>
        <input type="text" id="duracion" name="duracion" value="{{ old('duracion', $curso->duracion) }}">

        <label for="cupos">Available spots</label>
        <input type="number" id="cupos" name="cupos" min="1" value="{{ old('cupos', $curso->cupos) }}" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">

        <label for="status">Status</label>
        <select id="status" name="status" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          <option value="pending"  {{ old('status', $curso->status) == 'pending'  ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ old('status', $curso->status) == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ old('status', $curso->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <a href="/admin/dashboard" class="btn btn-secondary" style="text-decoration:none;text-align:center;">Cancel</a>
        </div>
      </form>
    </div>
  </section>

@endsection
