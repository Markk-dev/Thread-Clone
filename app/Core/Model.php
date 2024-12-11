<?php

// app/Core/Model.php
namespace App\Core;

use mysqli;

class Model
{
    protected $db;
    
    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "threadClone");

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function closeConnection()
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}
