<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteCurso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'docentes_cursos';

    protected $fillable = [
        'docente_id',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }
}
