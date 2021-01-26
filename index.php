<?php

use Camagru\Core\Router;
use Camagru\Core\Request;
use Camagru\Core\Config;

require_once './app/bootstrap.php';

$configInstance = Config::getInstance();
$request = new Request();
$routerClass = new Router($configInstance->getRoutes());