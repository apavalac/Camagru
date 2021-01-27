<?php


namespace Camagru\Core;


class Request
{
    private string $method;
    private string $path;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_SERVER['REQUEST_URI'];
    }
}