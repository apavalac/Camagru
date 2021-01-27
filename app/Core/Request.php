<?php


namespace Camagru\Core;


class Request
{

    private string $method;
    private string $path;
    private array $data;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_SERVER['REQUEST_URI'];

        if($this->method == GET) {
            $this->data = $_GET;
        } else if ($this->method == POST) {
            $this->data= $_POST;
        }
    }

    public function getMethod() : string {
        return ($this->method);
    }

    public function getPath() : string {
        return ($this->path);
    }

    public function getData(string $key) {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

}