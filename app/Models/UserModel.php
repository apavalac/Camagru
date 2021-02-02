<?php


namespace Camagru\Models;


use Camagru\Classes\User;

class UserModel extends \Camagru\Core\Model
{
    public function __construct() {
        parent::__construct('Camagru\Classes\User', 'users');
    }

    public function save(User $user) {
        $this->db->saveUser($user);
    }

    public function getByEmail($email) {
        $user = $this->db->getUserByEmail($email, $this->className);
    }

}