<?php
namespace App\Models;

use App\Config\Database;

class UserProfile
{
    private $db;

    public function __construct()
    {
        $database = new Database();  
        $this->db = $database->getConnection();  
    }

    public function getProfileByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM userprofile WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getTotalThreads($user_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM threads WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

}
    