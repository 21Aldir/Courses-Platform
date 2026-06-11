@extends('layouts.app')

@section('title', 'Explore Courses — Udemy v2')

@section('content')

  <section id="catalog-section">
    <div class="catalog-hero">
      <div class="hero-content">
        <h1>Explore Courses</h1>
        <p>Learn from the best instructors in the world. Expand your knowledge today.</p>
      </div>
    </div>

    <div class="catalog-body">
      <hr>

      <ul class="filter-list">
        <li style="background-color:#5C4EE5; color:#ffffff; padding:6px 16px; border-radius:20px; list-style:none; cursor:pointer;">All</li>
        @foreach($categorias as $cat)
          <li style="background-color:#ffffff; color:#5C4EE5; border:1px solid #5C4EE5; padding:6px 16px; border-radius:20px; list-style:none; cursor:pointer;">{{ $cat->nombre }}</li>
        @endforeach
      </ul>

      <div id="courses-grid">
        @forelse($cursos as $curso)
          @php $isFull = $curso->inscripciones_count >= $curso->cupos; @endphp
          @php $yaInscrito = auth()->check() && $curso->inscripciones->contains('user_id', auth()->id()); @endphp
          <article class="card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <span class="badge badge-category">{{ $curso->categoria->nombre ?? 'General' }}</span>
              @if($isFull)
                <span class="badge badge-full">Course Full</span>
              @else
                <span class="badge badge-available">{{ $curso->cupos - $curso->inscripciones_count }} spots left</span>
              @endif
            </div>
            <h3>{{ $curso->titulo }}</h3>
            <p><i>by {{ $curso->instructor->name ?? 'Sin instructor' }}</i></p>
            <small>{{ $curso->descripcion ?? 'Master this subject with a structured, hands-on curriculum.' }}</small>
            <hr>
            <div class="card-meta">
              <span>⏱ {{ $curso->duracion }}</span>
              <span>📶 {{ $curso->nivel }}</span>
              <span>👥 {{ $curso->inscripciones_count }}/{{ $curso->cupos }}</span>
            </div>

            @auth
              @if(auth()->user()->role === 'student')
                @if($yaInscrito)
                  <form action="/cursos/{{ $curso->id }}/inscripcion" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-secondary" style="width:100%;margin-top:auto;">Unenroll</button>
                  </form>
                @elseif(!$isFull)
                  <form action="/cursos/{{ $curso->id }}/inscripcion" method="POST">
                    @csrf
                    <button class="btn btn-enroll">Enroll</button>
                  </form>
                @else
                  <button class="btn btn-enroll" disabled>Course Full</button>
                @endif
              @else
                <button class="btn btn-enroll" disabled style="background:#e5e7eb;color:#9ca3af;cursor:not-allowed;">
                  Solo students pueden inscribirse
                </button>
              @endif
            @else
              <a href="/login" class="btn btn-enroll" style="text-align:center;text-decoration:none;">Log in to Enroll</a>
            @endauth
          </article>
        @empty
          <p style="color:#6b7280">No courses available yet.</p>
        @endforelse
      </div>
    </div>
  </section>

@endsection
