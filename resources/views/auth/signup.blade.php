@extends('layouts.app')

@section('title', 'Create account — Udemy v2')

@section('content')

  <section id="login-section">
    <h2>Create your account</h2>
    <p>Already have one? <a href="/login">Sign in</a></p>

    <div class="card login-card">

      <form id="signup-form" action="/registro" method="POST">
        @csrf

        <label for="name">Full name</label>
        <input type="text" id="name" name="name" placeholder="Jane Doe" value="{{ old('name') }}">

        <label for="email">Email address</label>
        <input type="text" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Min. 8 characters">

        <label for="password_confirmation">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password">

        <div class="radio-group">
          <input type="radio" id="role-student" name="role" value="student" {{ old('role', 'student') == 'student' ? 'checked' : '' }}>
          <label for="role-student">Student</label>
          <input type="radio" id="role-instructor" name="role" value="instructor" {{ old('role') == 'instructor' ? 'checked' : '' }}>
          <label for="role-instructor">Instructor</label>
        </div>

        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Create account</button>
          <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </form>

      <p id="signup-msg">
        @if($errors->any())
          <span style="color:red">{{ $errors->first() }}</span>
        @endif
      </p>
    </div>
  </section>

@endsection
