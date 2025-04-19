<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* ========================================================================== 
    Controlador que empleamos para hacer pruebas solamente con 
    la auth SPA de Sanctum y las rutas.api
    tambien probamos que lo podemos consumir desde las rutas de web.php
  ===========================================================================
*/

class LoginController extends Controller
{
    public function authenticate(Request $request) {

        //uso el helper validator() y le paso el request
        $validator = validator()->make($request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required'] 
            ]
        ); 

        // si las validaciones fallan, devuelvo los errores en formato JSON
        // 422 | Unprocessable Entity
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // en este punto, obtengo los datos limpios
        $credentials = $validator->valid();

        // intento autenticar tomando las credenciles provistas. 
        // Si esta todo ok, regenero la sesión (guarda los datos en una cookie).
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json('Autenticación exitosa'); 
        }

        //si la autenticación falla, devuelvo un error: 422 | Unprocessable Entity
        return response()->json('El usuario y/o contraseña son inválidos', 422);
        
    }
}
