<?php

require_once __DIR__."/../vendor/autoload.php";

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

$app->routeMiddleware([
    "auth" => App\Http\Middleware\Authenticate::class
]);

$app->register(App\Providers\AuthServiceProvider::class);

$app->router->group([
    "namespace" => "App\Http\Controllers",
], function ($router) {
    require __DIR__."/../routes/assetRouter.php";
    require __DIR__."/../routes/authRouter.php";
});

return $app;
