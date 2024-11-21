<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteCarrera extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estudiantes_carreras';

    protected $fillable = [
        'estudiante_id',
        'carrera_id'
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }
}
