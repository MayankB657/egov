<?php

use App\Exceptions\Handler;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckInstalltion;
use App\Http\Middleware\RolePermission;
use App\Http\Middleware\UpdateLastActivity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'dbdetails',
            'finalize'
        ]);
        $middleware->alias([
            'user.auth' => Authenticate::class,
            'permission' => RolePermission::class,
            'isInstalled' => CheckInstalltion::class,
            'lastactivity' => UpdateLastActivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withSingletons([
        Handler::class,
    ])->withSchedule(function (Schedule $schedule) {
        $schedule->command('user:update-expired-sessions')->everyFiveMinutes();
    })->create();
