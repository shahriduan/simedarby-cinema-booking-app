<?php

use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $responseTrait = new ExceptionHandlerHelper;
        
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

        $exceptions->render(function (NotFoundHttpException $e, Request $request) use ($responseTrait) {
            if ($request->expectsJson()) {
                return $responseTrait->responseNotFound();
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) use ($responseTrait) {
            if ($request->expectsJson()) {
                return $responseTrait->responseUnauthorized(__('auth.unauthenticated'));
            } else {
                return redirect()->guest($e->redirectTo($request) ?? route('login'));
            }
        });
    })->create();
