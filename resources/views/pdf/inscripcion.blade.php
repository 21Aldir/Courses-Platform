<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'DejaVu Sans', sans-serif;
      background: #ffffff;
      color: #111827;
      padding: 48px;
    }

    .header {
      background: #5C4EE5;
      color: white;
      padding: 32px 40px;
      border-radius: 12px;
      margin-bottom: 32px;
      text-align: center;
    }

    .header h1 { font-size: 26px; margin-bottom: 6px; }
    .header p  { font-size: 13px; opacity: 0.85; }

    .badge {
      display: inline-block;
      background: rgba(255,255,255,0.2);
      padding: 4px 14px;
      border-radius: 20px;
      font-size: 12px;
      margin-top: 10px;
    }

    .section {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      padding: 24px 28px;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 11px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #9ca3af;
      margin-bottom: 16px;
    }

    .row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .label { color: #6b7280; font-size: 13px; }
    .value { color: #111827; font-size: 13px; font-weight: 600; }

    .divider {
      border: none;
      border-top: 1px solid #e5e7eb;
      margin: 12px 0;
    }

    .footer {
      text-align: center;
      color: #9ca3af;
      font-size: 11px;
      margin-top: 40px;
    }

    .footer strong { color: #5C4EE5; }

    .stamp {
      border: 3px solid #5C4EE5;
      border-radius: 50%;
      width: 90px;
      height: 90px;
      margin: 20px auto;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #5C4EE5;
      font-size: 11px;
      font-weight: bold;
      line-height: 1.3;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>🎓 Udemy v2</h1>
    <p>Confirmación de inscripción</p>
    <span class="badge">✓ INSCRIPCIÓN CONFIRMADA</span>
  </div>

  <div class="section">
    <div class="section-title">Datos del estudiante</div>
    <div class="row">
      <span class="label">Nombre</span>
      <span class="value">{{ $estudiante->name }}</span>
    </div>
    <div class="row">
      <span class="label">Email</span>
      <span class="value">{{ $estudiante->email }}</span>
    </div>
  </div>

  <div class="section">
    <div class="section-title">Curso</div>
    <div class="row">
      <span class="label">Título</span>
      <span class="value">{{ $curso->titulo }}</span>
    </div>
    <div class="row">
      <span class="label">Categoría</span>
      <span class="value">{{ $curso->categoria->nombre ?? '—' }}</span>
    </div>
    <div class="row">
      <span class="label">Instructor</span>
      <span class="value">{{ $curso->instructor->name ?? 'Sin instructor' }}</span>
    </div>
    <hr class="divider">
    <div class="row">
      <span class="label">Nivel</span>
      <span class="value">{{ $curso->nivel }}</span>
    </div>
    <div class="row">
      <span class="label">Duración</span>
      <span class="value">{{ $curso->duracion }}</span>
    </div>
  </div>

  <div class="section">
    <div class="section-title">Detalles de inscripción</div>
    <div class="row">
      <span class="label">Fecha</span>
      <span class="value">{{ $fecha }}</span>
    </div>
    <div class="row">
      <span class="label">ID de inscripción</span>
      <span class="value">#{{ $inscripcion->id }}</span>
    </div>
  </div>

  <div class="stamp">UDEMY<br>v2<br>✓</div>

  <div class="footer">
    Generado el {{ $fecha }} — <strong>Udemy v2</strong> · Proyecto escolar
  </div>

</body>
</html>
