<?php

use Camagru\Core\Router;
use Camagru\Core\Config;

require_once './app/bootstrap.php';

$configInstance = Config::getInstance();
$routerClass = new Router($configInstance->getRoutes());