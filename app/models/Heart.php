<?php
namespace App\Models;

use App\Core\Model;

class Heart extends Model
{
    public function toggleHeart($threadId, $userId)
    {
        $query = "SELECT id FROM hearts WHERE thread_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $threadId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $query = "DELETE FROM hearts WHERE thread_id = ? AND user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $threadId, $userId);
            $stmt->execute();
            return "unhearted";
        } else {
            
            $query = "INSERT INTO hearts (thread_id, user_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $threadId, $userId);
            $stmt->execute();
            return "hearted";
        }
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
