<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Udemy v2')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/styles.css">
</head>
<body>

  <header>
    <nav>
      <a href="/" class="logo">🎓 Udemy <small>v2</small></a>
      <div class="nav-links">
        <a href="/cursos">Courses</a>
        @auth
          @if(auth()->user()->isAdmin())
            <a href="/admin/dashboard">Admin Panel</a>
          @elseif(auth()->user()->isInstructor())
            <a href="/instructor/dashboard">My Dashboard</a>
          @else
            <a href="/student/dashboard">My Courses</a>
          @endif
          <form action="/logout" method="POST" style="display:inline">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:0.95rem;font-weight:500;font-family:inherit;">Log out</button>
          </form>
        @else
          <a href="/login">Log in</a>
          <a href="/registro" class="btn-nav-signup">Sign up</a>
        @endauth
      </div>
    </nav>
  </header>

  @yield('content')

  <footer>
    <p>© {{ date('Y') }} Udemy v2 — <small>Proyecto escolar</small></p>
  </footer>

  @yield('scripts')

</body>
</html>
