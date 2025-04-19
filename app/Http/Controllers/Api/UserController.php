<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/* =============================================================
    controlador empleado para Sanctum con el manejo de TOKENS
   =============================================================
*/

class UserController extends Controller
{
    public function login (Request $request) {

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
        // aca puedo usar Auth:: o el helper auth()->
        if (Auth::attempt($credentials)) {
            // le pido a la clase usuario crear un token con nombre 'tokenApp')
            $token = Auth::user()->createToken('tokenApp')->plainTextToken; 
            // devuelvo los datos del user y token
            return response()->json(
                [
                    'isLoggedIn' => true,
                    'user' => Auth::user(),
                    'token' => $token
                ]
            ); 
        }

        //si la autenticación falla, devuelvo un error: 422 | Unprocessable Entity
        return response()->json('El usuario y/o contraseña son inválidos', 422);
        
    }

    public function logout (Request $request) {
        //si tengo un usr 
        if ($request->user()) {
            // $request->user()->currentAccessToken()->delete();  // destruyo el token usado para autenticar
            $request->user()->tokens()->delete();  // destruyo todos los tokens
        }

        session()->flush();  // destruyo la session
        return response()->json('OK');
    }

}
