<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerControlador extends Controller
{
    //ruta con parametro opcional
    function persona ($nombre='sin nombre', $apellido='sin apellido') {
        echo "nombre: $nombre <br>";
        echo "apellido: $apellido ";
    }

    //para usar parametros en una vista (ej: desde una db)
    function parametros () {
        $data = ['dato1','dato2'];
        $categorias = ['categoria1','categoria2'];
        // return view('contact2', ['data'=>$data, 'categorias'=>$categorias]);
        return view('contact2', compact('data', 'categorias')); //compact "resume" la linea anterior 
    }

}
