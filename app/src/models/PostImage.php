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
    public const PATH = 'post';

    public function __construct(
        private string $title,
        private string $image,
        private ?User $user = null,
        private ?int $id    = null
    ) {
        parent::__construct($title, $user, $id);
    }

    public static function getFeed(): array
    {
        $items = [];

        try {
            $db    = new Database;
            $query = $db->connect()->prepare(
                'SELECT * FROM posts ORDER BY post_id DESC'
            );
            $query->execute();

            while ($post = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostImage(
                    $post['title'],
                    $post['media'],
                    User::getById($post['user_id']),
                    $post['post_id']
                );

                $item->fetchLikes();
                $items[] = $item;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $items;
    }

    public static function getAll(User $user): array
    {
        $items = [];

        try {
            $db    = new Database;
            $query = $db->connect()->prepare(
                'SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_id DESC'
            );
            $query->execute(['user_id' => $user->getId()]);

            while ($post = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostImage(
                    $post['title'],
                    $post['media'],
                    $user,
                    $post['post_id']
                );

                $item->fetchLikes();
                $items[] = $item;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $items;
    }

    public static function getById(int $post_id): ?PostImage
    {
        try {
            $db    = new Database;
            $query = $db->connect()->prepare(
                'SELECT * FROM posts WHERE post_id = :post_id'
            );
            $query->execute(['post_id' => $post_id]);

            if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                return new PostImage(
                    $data['title'],
                    $data['media'],
                    User::getById($data['user_id']),
                    $data['post_id']
                );
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return null;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getImageUrl(): string
    {
        return '/public/images/'. self::PATH . '/' .$this->image;
    }
}