<?php
$app->router->get('', [HomeController::class, 'index']);
//$app->router->get('', [HomeController::class, 'index'],[AuthMiddleware::class]);
$app->router->post('', [HomeController::class, 'index']);

$app->router->get('/jwt', [JWTController::class, 'one']);

$app->router->get('/test', function () {
    echo "Route handler executed.";
}, [TestMiddleware::class]);


$app->router->resource('admin/media', 'media', MediaController::class);
$app->router->resource('admin/leads', 'lead', LeadsController::class);
