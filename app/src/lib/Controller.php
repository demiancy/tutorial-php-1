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

    public function render(View $view, array $data = [])
    {
        $this->view->render($view, $data);
    }

    public function post(string $param)
    {
        return $_POST[$param] ?? NULL;
    }

    public function get(string $param)
    {
        return $_GET[$param] ?? NULL;
    }

    public function file(string $param)
    {
        return $_FILES[$param] ?? NULL;
    }
}