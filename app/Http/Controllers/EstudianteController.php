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
use App\Models\Estudiante;

class EstudianteController extends Controller
{
    public function viewDatos($id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante)
            return response()->json('Estudiante no encontrado', 404);
        return view('estudiantes.perfil', ['estudiante' => $estudiante]);
    }

    public function viewEstudiante($id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante)
            return response()->json('Estudiante no encontrado', 404);
        $estudiantes_cursos = EstudianteCurso::where('estudiante_id', $id)->with('curso')->get();
        $cursos = [];
        foreach ($estudiantes_cursos as $estudiante_curso) {
            $cursos[] = $estudiante_curso->curso;
        }
        return view('estudiantes.inicio', ['estudiante' => $estudiante, 'cursos' => $cursos]); 
    }

    public function viewInscribirCurso($id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante)
            return response()->json('Estudiante no encontrado', 404);
        return view('estudiantes.inscribir.curso', ['estudiante' => $estudiante]);
    }

    public static function inscribirCurso(Request $request, $id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante)
            return response()->json('Estudiante no encontrado', 404);
        $validate = $request->validate([
            'curso_id' => 'required|integer'
        ]);
        $curso = Curso::find($validate['curso_id']);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        $estudiante_curso_datos = [
            'estudiante_id' => $estudiante->id,
            'curso_id' => $curso->id
        ];
        $estudiante_curso = EstudianteCurso::create($estudiante_curso_datos);
        $docente = DocenteCurso::where('curso_id', $curso->id)->first()->docente;
        $tareas = TareaAsignada::where('curso_id', $curso->id)->get();
        $examenes = ExamenAsignado::where('curso_id', $curso->id)->get();

        foreach ($tareas as $tarea) {
            $tarea_asignada_datos = [
                'estudiante_id' => $estudiante->id,
                'tarea_id' => $tarea->tarea->id,
                'curso_id' => $curso->id,
                'nota' => 0
            ];
            TareaAsignada::create($tarea_asignada_datos);
        }

        foreach ($examenes as $examen) {
            $examen_asignado_datos = [
                'estudiante_id' => $estudiante->id,
                'examen_id' => $examen->examen->id,
                'curso_id' => $curso->id,
                'nota' => 0
            ];
            ExamenAsignado::create($examen_asignado_datos);
        }

        return redirect()->route('estudiantes.inicio', ['id' => $estudiante->id]);
    }

    public function viewCurso($id, $curso_id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante)
            return response()->json('Estudiante no encontrado', 404);
        $curso = Curso::find($curso_id);
        if (!$curso)
            return response()->json('Curso no encontrado', 404);
        $tareas = TareaAsignada::where('estudiante_id', $estudiante->id)->where('curso_id', $curso->id)->get();
        $examenes = ExamenAsignado::where('estudiante_id', $estudiante->id)->where('curso_id', $curso->id)->get();
        return view('estudiantes.curso', ['estudiante' => $estudiante, 'curso' => $curso, 'tareas' => $tareas, 'examenes' => $examenes]);
    }
}
