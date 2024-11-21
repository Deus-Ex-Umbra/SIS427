<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\DocenteCurso;
use App\Models\EstudianteCurso;
use App\Models\Tarea;
use App\Models\Examen;
use App\Models\TareaAsignada;
use App\Models\ExamenAsignado;

class DocenteController extends Controller
{
    public function viewDocente($id) {
        $docente = Docente::find($id);
        if (!$docente)
            return response()->json('Docente no encontrado', 404);
        $docentes_cursos = DocenteCurso::where('docente_id', $id)->with('curso')->get();
        $cursos = [];
        foreach ($docentes_cursos as $docente_curso) {
            $cursos[] = $docente_curso->curso;
        }
        return view('docentes.inicio', ['docente' => $docente, 'cursos' => $cursos]); 
    }

    public function viewCreateCurso($id) {
        $docente = Docente::find($id);
        if (!$docente)
            return response()->json('Docente no encontrado', 404);
        return view('docentes.create.curso', ['docente' => $docente]);
    }

    public static function createCurso(Request $request, $id) {
        $docente = Docente::find($id);
        if (!$docente)
            return response()->json('Docente no encontrado', 404);
        $validate = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string'
        ]);
        $curso = Curso::create($validate);
        $docente_curso_datos = [
            'docente_id' => $docente->id,
            'curso_id' => $curso->id
        ];
        DocenteCurso::create($docente_curso_datos);
        return redirect()->route('docentes.inicio', ['id' => $docente->id]);
    }

    public function viewCurso($docente_id, $curso_id) {
        $docente = Docente::find($docente_id);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        $tareas_asignadas = TareaAsignada::where('curso_id', $curso_id)->get();
        $tareas = [];
        foreach ($tareas_asignadas as $tarea_asignada) {
            $tareas[] = $tarea_asignada->tarea;
        }
        $tareas = array_unique($tareas);

        $examenes_asignados = ExamenAsignado::where('curso_id', $curso_id)->get();
        $examenes = [];
        foreach ($examenes_asignados as $examen_asignado) {
            $examenes[] = $examen_asignado->examen;
        }
        //Asegurarse que los examenes sean únicos:
        $examenes = array_unique($examenes);
        return view('docentes.curso', ['curso' => $curso, 'tareas' => $tareas, 'examenes' => $examenes, 'docente' => $docente]);
    }

    public function viewCreateTarea($docente_id, $curso_id) {
        $docente = Docente::find($docente_id);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        return view('docentes.create.tarea', ['curso' => $curso, 'docente' => $docente]);
    }

    public static function createTarea(Request $request, $docente_id, $curso_id) {
        $docente = Docente::find($docente_id);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        $validate = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date'
        ]);
        $tarea = Tarea::create($validate);
        //Asignar la tarea a todos los estudiantes inscritos en el curso
        $estudiantes_cursos = EstudianteCurso::where('curso_id', $curso_id)->get();
        foreach ($estudiantes_cursos as $estudiante_curso) {
            $tarea_asignada_datos = [
                'docente_id' => $docente->id,
                'estudiante_id' => $estudiante_curso->estudiante_id,
                'curso_id' => $curso_id,
                'tarea_id' => $tarea->id,
                'calificacion' => 0
            ];
            $tarea_asignada = TareaAsignada::create($tarea_asignada_datos);
        }
        return redirect()->route('docentes.curso', ['id' => $docente->id, 'curso_id' => $curso->id]);
    }

    public function viewCreateExamen($docente_id, $curso_id) {
        $docente = Docente::find($docente_id);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        return view('docentes.create.examen', ['curso' => $curso, 'docente' => $docente]);
    }

    public static function createExamen(Request $request, $docente_id, $curso_id) {
        $docente = Docente::find($docente_id);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        $validate = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ruta_archivo' => 'required|string'
        ]);
        $examen = Examen::create($validate);
        //Asignar el examen a todos los estudiantes inscritos en el curso
        $estudiantes_cursos = EstudianteCurso::where('curso_id', $curso_id)->get();
        foreach ($estudiantes_cursos as $estudiante_curso) {
            $examen_asignado_datos = [
                'docente_id' => $docente->id,
                'estudiante_id' => $estudiante_curso->estudiante_id,
                'curso_id' => $curso_id,
                'examen_id' => $examen->id,
                'calificacion' => 0
            ];
            ExamenAsignado::create($examen_asignado_datos);
        }
        return redirect()->route('docentes.curso', ['id' => $docente->id, 'curso_id' => $curso->id]);
    }

    public function viewDatos($id) {
        $docente = Docente::find($id);
        if (!$docente)
            return response()->json('Docente no encontrado', 404);
        return view('docentes.perfil', ['docente' => $docente]);
    }
}