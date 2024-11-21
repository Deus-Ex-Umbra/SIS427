<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenAsignado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'examenes_asignados';

    protected $fillable = [
        'examen_id',
        'docente_id',
        'curso_id',
        'estudiante_id',
        'nota'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
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
