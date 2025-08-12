<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middlewares globales (pueden quedar como están)
    protected $middleware = [
        // ...
    ];

    // Middlewares por grupo (web, api)
    protected $middlewareGroups = [
        'web' => [
            // ...
            \App\Http\Middleware\Authenticate::class,
            // Otros middlewares de web...
        ],
        'api' => [
            'throttle:api',
            'bindings',
        ],
    ];

    // Middlewares asignados por nombre para rutas
    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    // 'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
  ];

}