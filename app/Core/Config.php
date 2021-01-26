<?php

namespace Camagru\Core;

class Config {
    private static ?Config $instance = null;
    private array $data = [];
    private array $routes;

    private function __construct() {

    }

    public static function getInstance() : Config {
        if(self::$instance == null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function getRoutes() : array {
        return ($this->routes);
    }

}