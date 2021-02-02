<?php

namespace Camagru\Controllers;

use Camagru\Classes\User;
use Camagru\Core\Controller;

class HomeController extends Controller
{
    public function index($options) {
        $this->View('Home');
    }
}