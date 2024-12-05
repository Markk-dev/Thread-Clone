<?php

namespace App\Models;

use App\Core\Model;

class Heart extends Model
{
    public function likeThread($threadId, $userId)
    {
        
        $query = "INSERT INTO hearts (thread_id, user_id) VALUES (?, ?) 
                  ON DUPLICATE KEY UPDATE thread_id = thread_id";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $threadId, $userId);
        $stmt->execute();
    }

    public function countHearts($threadId)
    {
        
        $query = "SELECT COUNT(*) AS heart_count FROM hearts WHERE thread_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $threadId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['heart_count'];
    }
}

