<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'examenes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'ruta_archivo'
    ];
}
