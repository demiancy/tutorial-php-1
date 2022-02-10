<?php

use Demiancy\Instagram\controllers\Signup;
use Demiancy\Instagram\controllers\Login;
use Demiancy\Instagram\controllers\Home;
use Demiancy\Instagram\controllers\Actions;
use Demiancy\Instagram\controllers\Profile;

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
    $controller = new Login();
    $controller->signout();
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
    $controller = new Home();
    $controller->store();
});

$router->get('/profile', function() { 
    $controller = new Profile();
    $controller->profileCurrentUser();
});

$router->get('/profile/{username}', function($username) { 
    $controller = new Profile();
    $controller->profileByUsername($username);
});

$router->post('/addLike', function() { 
    $controller = new Actions();
    $controller->like();
});

$router->run();