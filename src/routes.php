<?php
use MiladRahimi\PhpRouter\Router;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

$router = new Router();

$router->get('/', function () {
    return '<p>This is homepage!</p>';
});

$router->post('/blog/post/{id}', function ($id) {
    return HtmlResponse("<p>This is a post $id</p>");
});

$router->patch('/json', function () {
    return JsonResponse(['message' => 'This is a JSON response!']);
});

$router->dispatch();