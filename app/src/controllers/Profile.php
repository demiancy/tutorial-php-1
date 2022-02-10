<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;
use Demiancy\Instagram\models\User;


class Profile extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function profile(User $user)
    {
        $user->fetchPosts();
        
        $this->render('profile/index', [
            'user'  => $user
        ]);
    }

    public function profileCurrentUser()
    {
        $this->profile($this->currentUser());
    }

    public function profileByUsername(string $username)
    {
        if ($username && ($user = User::getByUsername($username))) {
            $this->profile($user);
        }

        
    }

}