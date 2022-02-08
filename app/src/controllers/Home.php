<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('home/index', ['user' => $this->currentUser()]);
    }
}