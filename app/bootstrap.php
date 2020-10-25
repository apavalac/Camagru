<?php

    // Load configs and default
    require_once 'Config/config.php';

    // Autoload Core Libraries
    spl_autoload_register(function($className)
    {
        require_once 'Libraries/' . $className . '.class.php';
    });
