<?php

namespace Demiancy\Instagram\lib;

use Demiancy\Instagram\lib\View;
use Demiancy\Instagram\models\User;

class Controller 
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function render(string $view, array $data = [])
    {
        $this->view->render($view, $data);
    }

    protected function currentUser(): ?User
    {
        return unserialize($_SESSION['user'] ?? null);
    }

    protected function post(string $param, string $default = null)
    {
        return $_POST[$param] ?? $default;
    }

    protected function get(string $param, string $default = null)
    {
        return $_GET[$param] ?? $default;
    }

    protected function file(string $param)
    {
        return $_FILES[$param] ?? NULL;
    }

    protected function redirect(string $url)
    {
        header("location: $url");
    }
}