<?php

use \Camagru\Core\Router;

$router = new Router();

$router->get('/', ['HomeController' => 'index'], [
    'auth' => 'false'
]);

$router->get('/gallery', ['GalleryController' => 'index'], [
    'auth' => 'false'
]);

$router->get('/settings', ['UserController' => 'settings'], [
    'auth' => 'true'
]);