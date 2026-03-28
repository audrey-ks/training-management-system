<?php

use Illuminate\Foundation\Application;

// For Laravel 10 style bootstrap
$app = new Application(dirname(__DIR__));

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->register(App\Providers\EventServiceProvider::class);

return $app;
