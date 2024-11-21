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
                <h2 class="mb-4">Tus Tareas</h2>
                @forelse ($tareas as $tarea)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tarea->nombre }}</h5>
                            <p class="card-text">{{ $tarea->descripcion }}</p>
                            <p class="card-text">Fecha de entrega: {{ $tarea->fecha_entrega }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No tienes tareas creadas en este momento.</p>
                @endforelse
                <a href=" {{ route('docentes.create.tarea', ['id' => $docente->id, 'curso_id' => $curso->id]) }} " class="btn btn-primary">Crear Tarea</a>
                @forelse ($examenes as $examen)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $examen->nombre }}</h5>
                            <p class="card-text">{{ $examen->descripcion }}</p>
                            <p class="card-text">Fecha: {{ $examen->fecha_inicio }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No tienes examenes creados en este momento.</p>
                @endforelse
                <a href=" {{ route('docentes.create.examen', ['id' => $docente->id, 'curso_id' => $curso->id]) }} " class="btn btn-primary">Crear Examen</a>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
