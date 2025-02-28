<?php

use App\Http\Controllers\PrimerControlador;
use Illuminate\Support\Facades\Route;


// resuelve el route del proyecto con una vista.
// para esto usa la clase Route, indicando la URI y la funcion callback que usa el helper 'view'
// no es necesario poner la extension del archivo ni su ruta (resourses/views/welcome.blade.php)
// el .blade es porque usa el template engine Blade 

Route::get('/', function () {
    return view('welcome');
});


Route::get('/contact', function () {
    return view('contact', ['nombre' => 'Rodrigo', 'edad' => 54]);
})->name('rutaContact');

// ejemplo parametros a la vista, pero en el controlador
Route::get('/parametros', [PrimerControlador::class, 'parametros']);

//utiliza un controlador con su nombre y el del método que usa
Route::get('/contact2', [PrimerControlador::class, 'contacto2']);
//ruta con parametros
Route::get('persona/{nombre?}/{apellido?}', [PrimerControlador::class, 'persona']);

//Route::resource('post', PrimerControlador::class);


// Route::get('/contact2', function () {
//     return view('contact2');
// })->name('rutaContact2');



//devuelvo solo un string
// Route::get('/test', function () {
//     return "welcome";   
// });

// ruta con un nombre interno
// Route::get('/test', function () {
//     return view('test');
// })->name('rutaTest');


// vista en subcarpeta
// Route::get('/subTest', function () {
//      return view('subcarpeta/subtest');   
// });

// pasar parametros a la vista
// Route::get('/helloWorld', function () {
//     // $edad = 54;
//     // $data = ['nombre' => 'Rodrigo', 'edad' => $edad];

//     // return view('helloWorld', $data);   
//     // codigo mas limpio:
//     return view('helloWorld', ['nombre' => 'Rodrigo', 'edad' => 54]);   
// });


