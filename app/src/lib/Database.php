<?php

namespace Demiancy\Instagram\lib;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    
    public function __construct()
    {
        $this->host     = $_ENV['HOST'];
        $this->db       = $_ENV['DB'];
        $this->user     = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset  = $_ENV['CHARSET'];
    }

    public function connect(): PDO
    {
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options    = [
                PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            return new PDO(
                $connection, 
                $this->user, 
                $this->password, 
                $options
            );
        } catch(PDOException $e) {
            throw $e;
        }
    }
}