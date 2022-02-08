<?php

namespace Demiancy\Instagram\models;

use Demiancy\Instagram\lib\Model;
use Demiancy\Instagram\lib\Database;
use Demiancy\Instagram\models\User;
use Demiancy\Instagram\models\Post;
use PDO;
use PDOException;

class PostImage extends Post 
{
    public function __construct(
        private string $title,
        private string $image,
        private ?User $user = null,
        private ?int $id   = null
    ) {
        parent::__construct($title, $user, $id);
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}