<?php


namespace Camagru\Core;

use Camagru\Classes\User;
use Camagru\Core\Config;
use \PDO;

class Database
{
    private $db;
    private $stm;
    private string $dsn;
    private $dbh;

    public static $instance = null;

    private function __construct() {
        $db_name = Config::getInstance()->get('db_name');
        $db_user = Config::getInstance()->get('db_user');
        $db_pass = Config::getInstance()->get('db_pass');
        $db_host = Config::getInstance()->get('db_host');
        $db_port = Config::getInstance()->get('db_port');

        $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host . ';port=' . $db_port;

        try {
            $this->dbh = new PDO($dsn, $db_user, $db_pass);
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

    public function saveUser(User $user) {
        $query = <<< SQL
            INSERT INTO `camagru`.`users` (`email`, `password`, `username`) VALUES
            (:email, :password, :username)
        SQL;

        $sth = $this->dbh->prepare($query);
        $sth->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $sth->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $sth->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);

        try {
            $sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getUserByEmail($email, $className) {
        $query = <<< SQL
            SELECT * FROM `camagru`.`users` WHERE `users`.`email` = :email
        SQL;

        $sth = $this->dbh->prepare($query);
        $sth->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            $sth->execute();
            $user = $sth->fetchAll(PDO::FETCH_CLASS, $className);

            if(isset($user[0])) {
                return $user[0];
            } else {
                return null;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

}