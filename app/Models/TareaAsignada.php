<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaAsignada extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tareas_asignadas';

    protected $fillable = [
        'tarea_id',
        'docente_id',
        'curso_id',
        'estudiante_id',
        'nota'
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    public function docente()
    {
        return $this->belongsTo(DocenteCurso::class, 'docente_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
