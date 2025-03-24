<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta de ejemplo sin autenticación
Route::get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//ruta al metodo personalizado, tipo GET
Route::get('category/all', [CategoryController::class, 'all']);
Route::get('category/slug/{slug}', [CategoryController::class, 'slug']);
Route::get('post/all', [PostController::class, 'all']);
Route::get('post/slug/{slug}', [PostController::class, 'slug']);

//habilito las rutas (tipo recurso) excepto create y edit
// Route::resource('category', CategoryController::class)->except(['create','edit']);
// Route::resource('post', PostController::class)->except(['create','edit']);
Route::apiResource('category', CategoryController::class);
Route::apiResource('post', PostController::class);



