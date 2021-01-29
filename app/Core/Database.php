<?php


namespace Camagru\Core;

use Camagru\Core\Config;
use \PDO;

class Database
{
    private $db;
    private $stm;
    private string $dsn;

    public static $instance = null;

    private function __construct() {
        $db_name = Config::getInstance()->get('db_name');
        $db_user = Config::getInstance()->get('db_user');
        $db_pass = Config::getInstance()->get('db_pass');

        $dsn = 'mysql:dbname=' . $db_name . ';host=127.0.0.1';

        try {
            $dbh = new PDO($dsn, $db_user, $db_pass);
            print_r($dbh);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        //echo $dsn;
    }

    public static function getInstance(): ?Database
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

}