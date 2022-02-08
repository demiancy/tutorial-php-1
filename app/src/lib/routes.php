<?php

use Demiancy\Instagram\controllers\Signup;

$router = new \Bramus\Router\Router();
session_start();

$router->get('/', function() { 
    echo "home";
});

$router->get('/login', function() {
    echo "login";
});

$router->post('/auth', function() {
    echo "auth";
});

$router->get('/signup', function() { 
    $controller = new Signup();
    $controller->render('signup/index');
});

$router->get('/signout', function() { 
    echo "signout";
});

$router->post('/register', function() { 
    echo "register";
});

$router->get('/home', function() { 
    echo "home";
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