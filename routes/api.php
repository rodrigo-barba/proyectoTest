<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\UserController;

// ejemplo simple login usando autenticacion SPA
// Route::post('user/login', [LoginController::class, 'authenticate']);

// ejemplo simple login usando autenticacion con Token
Route::post('user/login', [UserController::class, 'login']);

// Ruta de ejemplo SIN AUTENTICACION
// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

// Ruta de ejemplo CON AUTENTICACION
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//ruta al metodo personalizado, tipo GET
Route::get('category/all', [CategoryController::class, 'all']);
Route::get('category/slug/{slug}', [CategoryController::class, 'slug']);
Route::get('post/all', [PostController::class, 'all']);
Route::get('post/slug/{slug}', [PostController::class, 'slug']);


// Route::apiResource es ideal para APIs: no incluye rutas como /create o /edit, que son pensadas para vistas web.
// Route::resource es para aplicaciones web tradicionales (Blade) donde se renderizan vistas.

//habilito las rutas (tipo recurso) excepto create y edit
// Route::resource('category', CategoryController::class)->except(['create','edit']);
// Route::resource('post', PostController::class)->except(['create','edit']);

//protejo rutas CRUD de la API
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('post', PostController::class);
});

//ruta para subir archivos
Route::post('post/upload/{post}', [PostController::class, 'upload']);

//ruta logout
Route::post('user/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

