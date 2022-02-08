<?php

namespace Demiancy\Instagram\lib;

use Demiancy\Instagram\lib\View;

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

    protected function post(string $param)
    {
        return $_POST[$param] ?? NULL;
    }

    protected function get(string $param)
    {
        return $_GET[$param] ?? NULL;
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