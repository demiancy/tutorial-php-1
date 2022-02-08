<?php

namespace Demiancy\Instagram\models;

use Demiancy\Instagram\lib\Model;
use PDO;
use PDOException;

class User extends Model 
{
    private int $id;
    private array $posts;
    private string $profile;

    public function __construct(
        private string $name, 
        private string $password
    ) {
        $this->posts   = [];
        $this->profile = '';
        $this->id      = null;
    }

    public function save()
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