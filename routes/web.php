<?php

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// ── Catálogo (solo cursos aprobados) ──────────────────────────────────────────

Route::get('/', function () {
    $cursos     = Curso::with('categoria', 'instructor', 'inscripciones')
                    ->withCount('inscripciones')
                    ->where('status', 'approved')
                    ->latest()->get();
    $categorias = Categoria::all();
    return view('welcome', compact('cursos', 'categorias'));
});

Route::get('/cursos', fn() => redirect('/'));

// ── Auth ──────────────────────────────────────────────────────────────────────

Route::get('/login', fn() => view('auth.login'));

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if (Auth::user()->isAdmin())      return redirect('/admin/dashboard');
        if (Auth::user()->isInstructor()) return redirect('/instructor/dashboard');
        return redirect('/');
    }

    return back()->withInput()->with('error', 'Credenciales incorrectas.');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::get('/registro', fn() => view('auth.signup'));

Route::post('/registro', function (Request $request) {
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role'     => 'required|in:student,instructor',
    ]);

    $user = User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'role'     => $data['role'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);
    if ($user->isInstructor()) return redirect('/instructor/dashboard');
    return redirect('/');
});

// ── Student ───────────────────────────────────────────────────────────────────

Route::post('/cursos/{curso}/inscripcion', function (Curso $curso) {
    if (!Auth::check() || Auth::user()->role !== 'student') return redirect('/login');

    $yaInscrito = Inscripcion::where('user_id', Auth::id())
        ->where('curso_id', $curso->id)->exists();

    if ($yaInscrito || $curso->inscripciones()->count() >= $curso->cupos) {
        return redirect()->back();
    }

    Inscripcion::create(['user_id' => Auth::id(), 'curso_id' => $curso->id]);

    return redirect('/student/dashboard');
});

Route::get('/cursos/{curso}/inscripcion/pdf', function (Curso $curso) {
    if (!Auth::check()) return redirect('/login');

    $inscripcion = Inscripcion::where('user_id', Auth::id())
        ->where('curso_id', $curso->id)
        ->firstOrFail();

    $curso->load('categoria', 'instructor');

    $pdf = Pdf::loadView('pdf.inscripcion', [
        'estudiante'  => Auth::user(),
        'curso'       => $curso,
        'inscripcion' => $inscripcion,
        'fecha'       => now()->format('d/m/Y H:i'),
    ]);

    return $pdf->download('inscripcion-' . $curso->slug . '.pdf');
});

Route::delete('/cursos/{curso}/inscripcion', function (Curso $curso) {
    if (!Auth::check()) return redirect('/login');
    Inscripcion::where('user_id', Auth::id())->where('curso_id', $curso->id)->delete();
    return redirect()->back();
});

Route::get('/student/dashboard', function () {
    if (!Auth::check()) return redirect('/login');
    abort_if(Auth::user()->isAdmin() || Auth::user()->isInstructor(), 403);
    $cursos = Auth::user()
        ->inscripciones()
        ->with(['curso.categoria', 'curso.instructor', 'curso.inscripciones'])
        ->get()
        ->pluck('curso')
        ->filter()
        ->each(fn($c) => $c->loadCount('inscripciones'));

    return view('student.dashboard', compact('cursos'));
});

// ── Instructor (solo lectura) ─────────────────────────────────────────────────

Route::get('/instructor/dashboard', function () {
    if (!Auth::check()) return redirect('/login');
    abort_if(!Auth::user()->isInstructor(), 403);

    $misCursos  = Curso::with('categoria')->withCount('inscripciones')
                    ->where('instructor_id', Auth::id())->latest()->get();
    $catalogo   = Curso::with('categoria', 'instructor')
                    ->withCount('inscripciones')
                    ->where('status', 'approved')
                    ->latest()->get();
    $categorias = Categoria::all();

    return view('instructor.dashboard', compact('misCursos', 'catalogo', 'categorias'));
});

// ── Admin ─────────────────────────────────────────────────────────────────────

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('admin.dashboard', [
            'pendientes' => Curso::with('instructor', 'categoria')->where('status', 'pending')->get(),
            'cursos'     => Curso::with('instructor', 'categoria')->latest()->get(),
            'usuarios'   => User::latest()->get(),
        ]);
    });

    Route::post('/cursos/{curso}/approve', function (Curso $curso) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $curso->update(['status' => 'approved']);
        return redirect('/admin/dashboard');
    });

    Route::post('/cursos/{curso}/reject', function (Curso $curso) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $curso->update(['status' => 'rejected']);
        return redirect('/admin/dashboard');
    });

    Route::get('/cursos/create', function () {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('admin.create_curso', [
            'categorias'   => Categoria::all(),
            'instructores' => User::where('role', 'instructor')->get(),
        ]);
    });

    Route::post('/cursos', function (Request $request) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $data = $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'instructor_id' => 'nullable|exists:users,id',
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'nivel'         => 'required|in:Beginner,Intermediate,Advanced',
            'duracion'      => 'required|string|max:50',
            'cupos'         => 'required|integer|min:1',
            'status'        => 'required|in:pending,approved,rejected',
        ]);
        $slug = Str::slug($data['titulo']); $original = $slug; $i = 1;
        while (Curso::where('slug', $slug)->exists()) { $slug = $original . '-' . $i++; }
        $data['slug'] = $slug;
        Curso::create($data);
        return redirect('/admin/dashboard');
    });

    Route::get('/cursos/{curso}/edit', function (Curso $curso) {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('admin.edit', [
            'curso'      => $curso,
            'categorias' => Categoria::all(),
            'instructores' => User::where('role', 'instructor')->get(),
        ]);
    });

    Route::patch('/cursos/{curso}', function (Request $request, Curso $curso) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $data = $request->validate([
            'categoria_id'  => 'required|exists:categorias,id',
            'instructor_id' => 'nullable|exists:users,id',
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'nivel'         => 'required|in:Beginner,Intermediate,Advanced',
            'duracion'      => 'required|string|max:50',
            'cupos'         => 'required|integer|min:1',
            'status'        => 'required|in:pending,approved,rejected',
        ]);
        $slug = Str::slug($data['titulo']); $original = $slug; $i = 1;
        while (Curso::where('slug', $slug)->where('id', '!=', $curso->id)->exists()) { $slug = $original . '-' . $i++; }
        $data['slug'] = $slug;
        $curso->update($data);
        return redirect('/admin/dashboard');
    });

    Route::delete('/cursos/{curso}', function (Curso $curso) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $curso->delete();
        return redirect('/admin/dashboard');
    });

    Route::get('/usuarios/{usuario}/edit', function (User $usuario) {
        abort_if(!Auth::user()->isAdmin(), 403);
        return view('admin.edit_user', compact('usuario'));
    });

    Route::patch('/usuarios/{usuario}', function (Request $request, User $usuario) {
        abort_if(!Auth::user()->isAdmin(), 403);
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $usuario->id,
            'role'     => 'required|in:student,instructor,admin',
            'password' => 'nullable|min:8|confirmed',
        ]);
        $usuario->name  = $data['name'];
        $usuario->email = $data['email'];
        $usuario->role  = $data['role'];
        if (!empty($data['password'])) {
            $usuario->password = Hash::make($data['password']);
        }
        $usuario->save();
        return redirect('/admin/dashboard');
    });

    Route::delete('/usuarios/{usuario}', function (User $usuario) {
        abort_if(!Auth::user()->isAdmin(), 403);
        abort_if($usuario->id === Auth::id(), 403);
        $usuario->delete();
        return redirect('/admin/dashboard');
    });
});
