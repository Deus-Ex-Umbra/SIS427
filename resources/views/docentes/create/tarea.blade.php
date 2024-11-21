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

        <!-- Menú lateral -->
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

        <!-- Contenido principal -->
        <div class="flex-grow-1">
            <!-- Encabezado -->
            <header class="bg-primary text-white py-3 px-4">
                <h1 class="m-0"><a href=" {{ route('docentes.inicio', ['id' => $docente->id]) }} " class="text-white text-decoration-none">Campus Virtual</a></h1>
            </header>

            <!-- Cursos -->
            <main class="p-4">
                <h2 class="mb-4">Crear Tarea</h2>
                <form action="{{ route('docentes.store.tarea', ['id' => $docente->id, 'curso_id' => $curso->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Tarea</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción de la Tarea</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Tarea</button>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
