<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'setlocale' => SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Livewire's own endpoints (/livewire/update, /livewire/upload-file)
        // send Accept: application/json and need a JSON error response to
        // handle it client-side — restricting this to api/* only made every
        // exception during a Livewire request (a failed upload, a validation
        // error) come back as a redirect-to-HTML response instead. The
        // client tries to JSON-parse that HTML and the UI hangs with no
        // visible error. request()->expectsJson() is Laravel's own default
        // check; api/* stays as an explicit belt-and-braces addition.
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
