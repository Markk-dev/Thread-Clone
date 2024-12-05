<?php

namespace App\Models;

use App\Core\Model;

class Friend extends Model
{
    public function sendRequest($userId, $friendId)
    {
        
        $stmt = $this->db->prepare("INSERT INTO friend_requests (user_id, friend_id, status) VALUES (?, ?, 'pending')");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function acceptRequest($userId, $friendId)
    {
        
        $stmt = $this->db->prepare("UPDATE friend_requests SET status = 'accepted' WHERE user_id = ? AND friend_id = ?");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function rejectRequest($userId, $friendId)
    {
        
        $stmt = $this->db->prepare("UPDATE friend_requests SET status = 'rejected' WHERE user_id = ? AND friend_id = ?");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function getFriends($userId)
    {
        
        $stmt = $this->db->prepare("SELECT u.id, u.username FROM users u
                                    JOIN friend_requests fr ON (fr.user_id = u.id OR fr.friend_id = u.id)
                                    WHERE (fr.user_id = ? OR fr.friend_id = ?) AND fr.status = 'accepted'");
        $stmt->bind_param('ii', $userId, $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
