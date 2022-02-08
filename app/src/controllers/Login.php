<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;
use Demiancy\Instagram\models\User;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->render('login/index');
    }

    public function auth()
    {
        $username = $this->post('username');
        $password = $this->post('password', '');
        $user     = (!is_null($username)) ? User::ByUsername($username) : null;

        if ($user?->comparePassword($password)) {
            $_SESSION['user'] = serialize($user);
            $this->redirect('home');
        } else {
            error_log("Error in authenticating the user: $username");
            $this->redirect('login');
        }
    }
}