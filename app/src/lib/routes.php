<?php

use Demiancy\Instagram\controllers\Signup;
use Demiancy\Instagram\controllers\Login;
use Demiancy\Instagram\controllers\Home;

$router = new \Bramus\Router\Router();
session_start();

$router->get('/', function() { 
    echo "home";
});

$router->get('/login', function() {
    $controller = new Login();
    $controller->login();
});

$router->post('/auth', function() {
    $controller = new Login();
    $controller->auth();
});

$router->get('/signup', function() { 
    $controller = new Signup();
    $controller->signup();
});

$router->get('/signout', function() { 
    echo "signout";
});

$router->post('/register', function() { 
    $controller = new Signup();
    $controller->register();
});

$router->get('/home', function() { 
    $controller = new Home();
    $controller->index();
});

$router->post('/publish', function() { 
    echo "publish";
});

$router->get('/profile', function() { 
    echo "profile";
});

$router->get('/profile/{username}', function($username) { 
    echo "profile";
});

$router->post('/addLike', function() { 
    echo "add like";
});

$router->run();