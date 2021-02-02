<?php

require_once './app/config/config.php';

use Camagru\Core\Request;
use Camagru\Core\Database;

define('PROJECT_PATH', __DIR__);

function autoloader($className) {
    $indexSlash = strpos($className, '\\');
    $classSemiPath = substr($className, $indexSlash + 1);
    $classPath = str_replace('\\', '/', '.\\app\\' . $classSemiPath . '.php');

    require_once $classPath;
}

spl_autoload_register('autoloader');

require_once './app/config/routes.php';

$db = Database::getInstance();

$request = new Request();

if (!empty($router)) {
    $router->route($request);
}
