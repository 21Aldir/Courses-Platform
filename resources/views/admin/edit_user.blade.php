@extends('layouts.app')

@section('title', 'Edit User — Admin')

@section('content')

  <section id="login-section">
    <h2>Edit user <span style="color:#5C4EE5">{{ $usuario->name }}</span></h2>
    <p><a href="/admin/dashboard">← Back to dashboard</a></p>

    <div class="card login-card">

      @if($errors->any())
        <p><span style="color:red">{{ $errors->first() }}</span></p>
      @endif

      <form action="/admin/usuarios/{{ $usuario->id }}" method="POST">
        @csrf @method('PATCH')

        <label for="name">Full name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}">

        <label for="email">Email address</label>
        <input type="text" id="email" name="email" value="{{ old('email', $usuario->email) }}">

        <label for="role">Role</label>
        <select id="role" name="role" style="padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;font-family:inherit;font-size:0.95rem;background:#f9fafb;">
          <option value="student"    {{ old('role', $usuario->role) == 'student'    ? 'selected' : '' }}>Student</option>
          <option value="instructor" {{ old('role', $usuario->role) == 'instructor' ? 'selected' : '' }}>Instructor</option>
          <option value="admin"      {{ old('role', $usuario->role) == 'admin'      ? 'selected' : '' }}>Admin</option>
        </select>

        <label for="password">New password <small style="color:#9ca3af">(dejar vacío para no cambiar)</small></label>
        <input type="password" id="password" name="password" placeholder="Min. 8 characters">

        <label for="password_confirmation">Confirm new password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password">

        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <a href="/admin/dashboard" class="btn btn-secondary" style="text-decoration:none;text-align:center;">Cancel</a>
        </div>
      </form>
    </div>
  </section>

@endsection
