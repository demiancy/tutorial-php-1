<?php

namespace Demiancy\Instagram\models;

use Demiancy\Instagram\lib\Model;
use Demiancy\Instagram\lib\Database;
use Demiancy\Instagram\models\User;
use PDO;
use PDOException;

abstract class Post extends Model 
{
    private array $likes;

    public function __construct(
        private string $title, 
        private ?User $user = null,
        private ?int $id   = null
    ) {
        parent::__construct();
        $this->likes = [];
    }

    protected function fetchLikes()
    {
        $items = [];

        try {
            $query = $this->db->prepare(
                'SELECT * FROM likes WHERE post_id = :post_id'
            );
            $query->execute(['post_id' => $this->id]);

            while ($like = $query->fetch(PDO::FETCH_ASSOC)) {
                $items[] = new Like(
                    $like['post_id'],
                    $like['user_id'],
                    $like['id'],
                );
            }

            $this->likes = $items;

        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    protected function addLike(User $user)
    {
        $like = new Like(
            $this->id,
            $user->id
        );

        $like->save();
        $this->fetchLikes();
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setLikes(array $likes)
    {
        $this->likes = $likes;
    }

    public function getLikes(): array
    {
        return count($this->likes);
    }
}