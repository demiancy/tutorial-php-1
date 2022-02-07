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
    
    function __construct()
    {
        $this->host     = $_ENV['HOST'];
        $this->db       = $_ENV['DB'];
        $this->user     = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset  = $_ENV['CHARSET'];
    }
}