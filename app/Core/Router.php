<?php

namespace Camagru\Core;

class Router {
    private array $routeMap;
    private array $routePatern = [
        'integer' => '\d',
        'string' => '\w'
    ];

    function __construct(array $routes) {
        $this->routeMap = $routes;
    }
}