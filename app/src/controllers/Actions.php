<?php

namespace Demiancy\Instagram\controllers;

use Demiancy\Instagram\lib\Controller;
use Demiancy\Instagram\models\User;
use Demiancy\Instagram\models\PostImage;

class Actions extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function like()
    {
        //TODO: Verify that a user can only like once.
        if ($post_id = $this->post('post_id')) {
            $post = PostImage::getById($post_id);
            $post->addLike($this->currentUser());
        }

        $this->redirect($this->post('origin', 'home'));
    }
}