<?php

namespace Camagru\Core;

class Config {
    private static ?Config $instance = null;
    private array $data = [];

    private function __construct() {
        $this->data = json_decode(file_get_contents(PROJECT_PATH . '/app/config/database.json'), true);
    }

    public static function getInstance() : Config {
        if(self::$instance == null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function get($key) {
        foreach ($this->data as $k => $value) {
            if (isset($value[$key])) {
                return $value[$key];
            }
        }

        return null;
    }

}