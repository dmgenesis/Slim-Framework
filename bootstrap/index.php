<?php
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ .'/../vendor/autoload.php';

$container  = new Container;
$settings   = require __DIR__ .'/../app/settings.php';
$settings($container);

AppFactory::setContainer($container);

$app = AppFactory::create();

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$route = require __DIR__ . '/../app/routes.php';
$route($app);

$app->addErrorMiddleware(true, true, true);

$app->get('/', function(Request $request, Response $response, $parameters){
   $response->getBody()->write('Hello World!');

   return $response;
});

$app->run();  