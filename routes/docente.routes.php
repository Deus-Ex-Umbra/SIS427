<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocenteController;

Route::get('docente/{id}', [DocenteController::class, 'viewDocente'])->name('docentes.inicio');
Route::get('docente/{id}/curso/create', [DocenteController::class, 'viewCreateCurso'])->name('docentes.create.curso');
Route::post('docente/{id}/curso/create', [DocenteController::class, 'createCurso'])->name('docentes.store.curso');
Route::get('docente/{id}/curso/{curso_id}', [DocenteController::class, 'viewCurso'])->name('docentes.curso');
Route::get('docente/{id}/curso/{curso_id}/tarea/create', [DocenteController::class, 'viewCreateTarea'])->name('docentes.create.tarea');
Route::post('docente/{id}/curso/{curso_id}/tarea/create', [DocenteController::class, 'createTarea'])->name('docentes.store.tarea');
Route::get('docente/{id}/curso/{curso_id}/examen/create', [DocenteController::class, 'viewCreateExamen'])->name('docentes.create.examen');
Route::post('docente/{id}/curso/{curso_id}/examen/create', [DocenteController::class, 'createExamen'])->name('docentes.store.examen');
Route::get('docente/{id}/datos', [DocenteController::class, 'viewDatos'])->name('docentes.perfil');