<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteCurso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estudiantes_cursos';

    protected $fillable = [
        'estudiante_id',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }
}
