<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tareas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_entrega',
        'ruta_archivo'
    ];
}
