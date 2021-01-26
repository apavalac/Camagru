<?php

function autoloader($className) {
    $indexSlash = strpos($className, '\\');
    $classSemiPath = substr($className, $indexSlash + 1);
    $classPath = str_replace('\\', '/', '.\\app\\' . $classSemiPath . '.php');

    require_once $classPath;
}

spl_autoload_register('autoloader');