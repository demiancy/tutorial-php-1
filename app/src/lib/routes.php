<?php

use Demiancy\Instagram\controllers\Signup;
use Demiancy\Instagram\controllers\Login;
use Demiancy\Instagram\controllers\Home;
use Demiancy\Instagram\controllers\Actions;
use Demiancy\Instagram\controllers\Profile;

$router = new \Bramus\Router\Router();
session_start();

function notAuth()
{
    if (!isset($_SESSION['user'])) {
        header("location: /login");
        exit();
    }
}

function auth()
{
    if (isset($_SESSION['user'])) {
        header("location: /home");
        exit();
    }
}


$router->get('/', function() {
    header("location: /home");
});

$router->get('/login', function() {
    auth();
    $controller = new Login();
    $controller->login();
});

$router->post('/auth', function() {
    auth();
    $controller = new Login();
    $controller->auth();
});

$router->get('/signup', function() {
    auth();
    $controller = new Signup();
    $controller->signup();
});

$router->get('/signout', function() {
    notAuth();
    $controller = new Login();
    $controller->signout();
});

$router->post('/register', function() {
    auth();
    $controller = new Signup();
    $controller->register();
});

$router->get('/home', function() {
    notAuth();
    $controller = new Home();
    $controller->index();
});

$router->post('/publish', function() {
    notAuth();
    $controller = new Home();
    $controller->store();
});

$router->get('/profile', function() {
    notAuth();
    $controller = new Profile();
    $controller->profileCurrentUser();
});

$router->get('/profile/{username}', function($username) {
    notAuth();
    $controller = new Profile();
    $controller->profileByUsername($username);
});

$router->post('/addLike', function() {
    notAuth();
    $controller = new Actions();
    $controller->like();
});

$router->run();