<?php

use App\Http\Middleware\OnceBasic;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(OnceBasic::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->reportable(function (Throwable $e) {});

        $exceptions->render(function (Throwable $exception, $request) {
            if ($exception instanceof NotFoundHttpException) {
                if (request()->is('api/*') && ($exception->getPrevious() instanceof ModelNotFoundException)) {
                    return new JsonResponse([
                        'error' => [
                            'message' => 'Not Found!'
                        ]
                    ], 404);
                }
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return new JsonResponse([
                    'error' => [
                        'message' => 'Not Supported for this route!'
                    ]
                ], 404);
            }
            return null;
        });
    })
    ->create();
