<?php

namespace Demiancy\Instagram\lib;

use Demiancy\Instagram\lib\View;

class Controller 
{
    private View $view;

    function __construct()
    {
        $this->view = new View();
    }

    public function render(View $view, array $data = [])
    {
        $this->view->render($view, $data);
    }

    function post(string $param)
    {
        return $_POST[$param] ?? NULL;
    }

    function get(string $param)
    {
        return $_GET[$param] ?? NULL;
    }

    function file(string $param)
    {
        return $_FILES[$param] ?? NULL;
    }
}