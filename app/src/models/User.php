<?php

namespace Demiancy\Instagram\models;

use Demiancy\Instagram\lib\Model;
use Demiancy\Instagram\lib\Database;
use Demiancy\Instagram\models\PostImage;
use PDO;
use PDOException;

class User extends Model 
{
    private array $posts;

    public function __construct(
        private string $username, 
        private string $password,
        private ?int $id = null,
        private string $profile = ''
    ) {
        parent::__construct();
        $this->posts = [];
    }

    public function save(): bool
    {
        try {
            //TODO: Validate user
            $hash  = $this->getHashedPassword();
            $query = $this->prepare(
                'INSERT INTO users (username, password, profile) VALUES (:username, :password, :profile)'
            );

            $query->execute([
                'username' => $this->username,
                'password' => $hash,
                'profile'  => $this->profile
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
    }

    public function comparePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function getByUsername(string $username): ?User
    {
        try {
            $db    = new Database;
            $query = $db->connect()->prepare(
                'SELECT * FROM users WHERE username = :username'
            );
            $query->execute(['username' => $username]);
            
            return $this->get($query);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public static function getById(int $id): ?User
    {
        try {
            $db    = new Database;
            $query = $db->connect()->prepare(
                'SELECT * FROM users WHERE id = :id'
            );
            $query->execute(['username' => $username]);

            return $this->get($query);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function publish(PostImage $post)
    {
        try {
            $query = $this->prepare(
                'INSERT INTO posts (user_id, title, media) VALUES (:user_id, :title, :media)'
            );

            $query->execute([
                'user_id' => $this->getId(),
                'title'   => $post->getTitle(),
                'media'   => $post->getImage()
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
    }

    protected function get($query): ?user
    {
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            return new User(
                $data['username'], 
                $data['password'],
                $data['user_id'],
                $data['profile']
            );
        }

        return null;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPosts(array $posts)
    {
        $this->posts = $posts;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    public function setProfile(string $profile)
    {
        $this->profile = $profile;
    }

    public function getProfile(): string
    {
        return $this->profile;
    }

    private function getHashedPassword()
    {
        return password_hash(
            $this->password,
            PASSWORD_DEFAULT,
            ['cost' => 10]
        );
    }
}