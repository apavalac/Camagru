<?php

namespace Camagru\Core;

use \Camagru\Core\Request;

class Router {

    private array $postRoutes;
    private array $getRoutes;

    public function __construct() {
        $this->postRoutes = [];
        $this->getRoutes = [];
    }

    public function post(string $route, array $controller, $options) {

        foreach ($controller as $class => $method) {
            $this->postRoutes[$route]['controller'] = $class;
            $this->postRoutes[$route]['method'] = $method;
        }

        $this->postRoutes[$route]['options'] = $options;
    }

    public function get(string $route, array $controller, $options) {
        foreach ($controller as $class => $method) {
            $this->getRoutes[$route]['controller'] = $class;
            $this->getRoutes[$route]['method'] = $method;
        }

        $this->getRoutes[$route]['options'] = $options;
    }

    public function route(Request $request) {
        $route = $this->matchRoute($request->getPath(), $request->getMethod());

        if ($route != null) {
            call_user_func_array(['Camagru\Controllers\\' . $route['controller'], $route['method']], [$route['options']]);
        } else {
            call_user_func_array(['Camagru\Controllers\HomeController', 'index'], [[
                'auth' => 'false'
            ]]);
        }
    }

    private function matchRoute(string $pathToMatch, string $method) {
        $routesToCompare = [];

        if($method == GET) {
            $routesToCompare = $this->getRoutes;
        } else if ($method == POST) {
            $routesToCompare = $this->postRoutes;
        }

        foreach($routesToCompare as $key => $value) {
            if($pathToMatch == $key) {
                return $routesToCompare[$key];
            }
        }

        return null;
    }
}