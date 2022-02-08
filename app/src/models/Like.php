<?php

namespace Demiancy\Instagram\models;

use Demiancy\Instagram\lib\Model;
use Demiancy\Instagram\lib\Database;
use PDOException;

class Like extends Model 
{
    public function __construct(
        private int $post_id,
        private int $user_id,
        private ?int $id = null
    ) {
        parent::__construct();
    }

    public function save(): bool
    {
        try {
            $query = $this->prepare(
                'INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)'
            );

            $query->execute([
                'post_id' => $this->post_id,
                'user_id' => $this->user_id
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}