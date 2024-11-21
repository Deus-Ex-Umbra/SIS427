<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
            <h4 class="text-center"><a href=" {{ route('docentes.inicio', ['id' => $docente->id]) }} " class="text-white text-decoration-none">Campus Virtual</a></h4>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href=" {{ route('docentes.perfil', ['id' => $docente->id]) }} " class="nav-link text-white">Ver Perfil</a>
                </li>
                <li class="nav-item">
                <a href=" {{ route('user.thinking') }}" class="nav-link text-white">Programar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('docentes.create.curso', ['id' => $docente->id]) }}" class="nav-link text-white">Crear Curso</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('user.logout') }}" method="POST" class="nav-link text-white">
                        @csrf
                        <button type="submit" class="btn btn-link text-white">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="flex-grow-1">
            <header class="bg-primary text-white py-3 px-4">
                <h1 class="m-0"><a href=" {{ route('docentes.inicio', ['id' => $docente->id]) }} " class="text-white text-decoration-none">Campus Virtual</a></h1>
            </header>
            <main class="p-4">
                <form action="{{ route('docentes.store.curso', ['id' => $docente->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Curso</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción del Curso</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
