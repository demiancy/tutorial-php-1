<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;
use Demiancy\Instagram\lib\UtilImages;
use Demiancy\Instagram\models\User;

class Signup extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function signup()
    {
        $this->render('signup/index');
    }

    public function register()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $profile  = $this->file('profile');

        if (
            !is_null($username)
            && !is_null($password)
            && !is_null($profile)
        ) {
            $image = UtilImages::store($profile, 'user');
            $user  = new User($username, $password);
            $user->setProfile($image);
            $user->save();
            $this->redirect('/login');
        } else {
            $this->render('errors/index');
        }
    }
}