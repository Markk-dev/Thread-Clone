<?php
namespace App\Config;

class database
{
    private $host = 'localhost';
    private $db_name = 'threadClone';
    private $username = 'root'; 
    private $password = ''; 
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        // Establish a MySQLi connection
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check if the connection is successful
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

