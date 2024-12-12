<?php

namespace App\Models;

use App\Core\Model;

class Friend extends Model
{

    public function getFriends($userId)
    {
        
        $stmt = $this->db->prepare("SELECT u.id, u.username 
                                    FROM users u
                                    JOIN friends f ON (f.user_id = u.id OR f.friend_id = u.id)
                                    WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted'");
        $stmt->bind_param('ii', $userId, $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);  
    }

}
