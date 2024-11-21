<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

Route::get('/estudiante/{id}/perfil', [EstudianteController::class, 'viewDatos'])->name('estudiantes.perfil');
Route::get('/estudiante/{id}', [EstudianteController::class, 'viewEstudiante'])->name('estudiantes.inicio');
Route::get('/estudiante/{id}/curso/inscribir', [EstudianteController::class, 'viewInscribirCurso'])->name('estudiantes.inscribir.curso');
Route::post('/estudiante/{id}/curso/inscribir', [EstudianteController::class, 'inscribirCurso'])->name('estudiantes.store.inscribir.curso');
Route::get('/estudiante/{id}/curso/{curso_id}', [EstudianteController::class, 'viewCurso'])->name('estudiantes.curso');