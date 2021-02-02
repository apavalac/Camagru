<?php

namespace Camagru\Core;

class Controller {
    public function Model(string $modelName) {
        if(file_exists(PROJECT_PATH . '/Models/' . $modelName . 'Model.php')) {
            return new ('Camagru\Models\\' . $modelName . 'Model')();
        } else {
            return null;
        }
    }

    public function View(string $viewName, $data = []) {
        if(file_exists(PROJECT_PATH . '/Views/' . $viewName . 'View.php')) {
            require_once PROJECT_PATH . '/Views/' . $viewName . 'View.php';
        } else {
            require_once PROJECT_PATH . '/Views/404.html';
        }
    }
}