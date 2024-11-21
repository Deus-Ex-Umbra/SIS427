<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

require __DIR__.'/user.routes.php';
require __DIR__.'/docente.routes.php';
require __DIR__.'/estudiante.routes.php';