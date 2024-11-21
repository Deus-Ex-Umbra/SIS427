<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Registro de Perfil</h3>
    <form method="POST" action="{{ route('user.create') }}">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" required>

        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select id="role" name="role" class="form-select" required>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
    </form>
    <a href="{{ route('user.login') }}" class="d-block mt-3 text-center">
        <button class="btn btn-link">
            Iniciar Sesión
        </button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
