<?php


namespace Camagru\Classes;


class Image
{
    private $id;
    private $path;
    private $user_id;
    private $created_at;

    public function __construct($path, $user_id, $created_at) {
        $this->path = $path;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }
}