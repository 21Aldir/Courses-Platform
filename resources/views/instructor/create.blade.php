@extends('layouts.app')

@section('title', 'New Course — Udemy v2')

@section('content')

  <section id="login-section">
    <h2>Create a new course</h2>
    <p><a href="/">← Back to catalog</a></p>

    <div class="card login-card">

      @if($errors->any())
        <p><span style="color:red">{{ $errors->first() }}</span></p>
      @endif

      <form action="/instructor/cursos" method="POST">
        @csrf

        <label for="titulo">Course title</label>
        <input type="text" id="titulo" name="titulo" placeholder="e.g. Advanced React Patterns" value="{{ old('titulo') }}">

        <label for="categoria_id">Category</label>
        <select id="categoria_id" name="categoria_id" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          <option value="">Select a category</option>
          @foreach($categorias as $cat)
            <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
          @endforeach
        </select>

        <label for="descripcion">Description</label>
        <textarea id="descripcion" name="descripcion" rows="3" placeholder="What will students learn?" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">{{ old('descripcion') }}</textarea>

        <label for="nivel">Level</label>
        <select id="nivel" name="nivel" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          <option value="Beginner" {{ old('nivel') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
          <option value="Intermediate" {{ old('nivel') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
          <option value="Advanced" {{ old('nivel') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
        </select>

        <label for="duracion">Duration</label>
        <input type="text" id="duracion" name="duracion" placeholder="e.g. 6 weeks" value="{{ old('duracion') }}">

        <label for="cupos">Available spots</label>
        <input type="number" id="cupos" name="cupos" placeholder="e.g. 50" min="1" value="{{ old('cupos') }}" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">

        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Create course</button>
          <a href="/" class="btn btn-secondary" style="text-decoration:none;text-align:center;">Cancel</a>
        </div>
      </form>
    </div>
  </section>

@endsection
