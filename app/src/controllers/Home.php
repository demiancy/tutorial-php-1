<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;
use Demiancy\Instagram\models\PostImage;
use Demiancy\Instagram\lib\UtilImages;

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

    public function store()
    {
        $title = $this->post('title');
        $image = $this->file('image');

        if (!is_null($title) && !is_null($image)) {
            $fileName = UtilImages::store($image, 'post');
            $post     = new PostImage($title, $fileName);

            $this->currentUser()->publish($post);
        } else {
            $this->redirect('/home');
        }

        $this->redirect('/home');
    }
}