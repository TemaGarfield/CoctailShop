<?php

use App\controller\CartController;
use App\controller\CoctailController;
use App\controller\MainController;
use App\controller\SizeController;
use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;



$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    PDO::class => function () {
        return new PDO("mysql:host=localhost;dbname=dima_db", 'tema', 'password');
    },

    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
]);
try {
    $container = $containerBuilder->build();
//    return $container;
} catch (Exception $e) {
    var_dump($e->getMessage());
    die();
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/first-serious-project/', [MainController::class, 'index']);
    $r->addRoute('GET', '/first-serious-project/getAll', [MainController::class, 'getCoctailsWithSizes']);
    $r->addRoute('POST', '/first-serious-project/addToCart', [CartController::class, 'addToCart']);
    $r->addRoute('POST', '/first-serious-project/convert', [MainController::class, 'convert']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump('404');
        die();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump('405');
        die();
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        $container->call($handler, $vars);
        break;
}

