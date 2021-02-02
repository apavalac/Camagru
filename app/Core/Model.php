<?php


namespace Camagru\Core;


class Model
{
    protected $table;
    protected $className;
    protected $db;

    public function __construct($className, $table) {
        $this->table = $table;
        $this->className = $className;
        $this->db = Database::getInstance();
    }
}