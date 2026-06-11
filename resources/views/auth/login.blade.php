@extends('layouts.app')

@section('title', 'Sign in — Udemy v2')

@section('content')

  <section id="login-section">
    <h2>Sign in to your account</h2>
    <p>Or <a href="/registro">create a new account</a></p>

    <div class="card login-card">

      @if(session('error'))
        <p><span style="color:red">{{ session('error') }}</span></p>
      @endif

      <form id="login-form" action="/login" method="POST">
        @csrf
        <label for="email">Email address</label>
        <input type="text" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••">

        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Sign in</button>
          <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </form>

      <p id="login-msg">
        @error('email') <span style="color:red">{{ $message }}</span> @enderror
      </p>
    </div>
  </section>

@endsection
