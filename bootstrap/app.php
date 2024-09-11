<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            "http://basic-laravel.test/request/hello",
            "http://basic-laravel.test/request/user",
            "http://basic-laravel.test/request/input",
            "http://basic-laravel.test/request/input/choose",
            "http://basic-laravel.test/request/input/type",
            "http://basic-laravel.test/request/filter/only",
            "http://basic-laravel.test/request/filter/except",
            "http://basic-laravel.test/file/upload",
            "http://basic-laravel.test/response/header"
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
