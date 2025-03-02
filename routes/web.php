<?php

use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

// resuelve el route del proyecto con una vista.
// para esto usa la clase Route, indicando la URI y la funcion callback que usa el helper 'view'
// no es necesario poner la extension del archivo ni su ruta (resourses/views/welcome.blade.php)
// el .blade es porque usa el template engine Blade 

Route::get('/', function () {
    return view('welcome');
});

Route::resource('post', PostController::class);


