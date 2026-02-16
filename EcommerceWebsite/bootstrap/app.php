<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/login');

        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });
    })->create();
