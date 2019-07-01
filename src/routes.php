<?php
use MiladRahimi\PhpRouter\Router;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

$router = new Router();

$router->get('/', function () {
    return '<p>This is homepage!</p>';
});


include 'Routes/heroRoutes.php';

include 'Routes/monsterRoutes.php';

include 'Routes/skillRoutes.php';

include 'Routes/battleRoutes.php';

$router->dispatch();

