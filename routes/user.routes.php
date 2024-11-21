<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('login', [UserController::class, 'viewLoginForm'])->name('user.viewLogin');
Route::post('login', [UserController::class, 'login'])->name('user.login');
Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('create', [UserController::class, 'viewCreatePerfil'])->name('user.viewCreate');
Route::post('create', [UserController::class, 'createPerfil'])->name('user.create');
Route::get('update/{id}', [UserController::class, 'getPerfil'])->name('user.viewUpdate');
Route::put('update/{id}', [UserController::class, 'updatePerfil'])->name('user.update');
Route::delete('delete/{id}', [UserController::class, 'deletePerfil'])->name('user.delete');
Route::get('execute', [UserController::class, 'viewExcecuteCode'])->name('user.thinking');
Route::post('execute', [UserController::class, 'excecuteCode'])->name('user.execute');