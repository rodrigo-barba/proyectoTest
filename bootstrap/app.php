<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // para usar tokens, el steful no debe estar (las API REST son stateless)
        //$middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function(NotFoundHttpException $e, $request) {
            //dd($e->getMessage()); //con esto veo el mensaje de error asociado
            //dd($request->wantsJson());
            if ($request->expectsJson()) {
                return response()->json('Recurso no encontrado', 404);            }
        });

        //Si quisiera manejar también el error de autenticación (UnauthorizedException):
        // $exceptions->render(function (UnauthorizedHttpException $e, $request) {
        //     if ($request->expectsJson()) {
        //         return response()->json('No autorizado', 401);
        //     }
        // });

    })->create();
