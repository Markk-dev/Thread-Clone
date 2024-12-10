<?php

namespace App\Models;

use App\Core\Model;

class Friend extends Model
{
    public function sendRequest($userId, $friendId)
    {
        // Insert a new friend request with status 'pending'
        $stmt = $this->db->prepare("INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'pending')");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function acceptRequest($userId, $friendId)
    {
        // Update the status to 'accepted' for the given user and friend
        $stmt = $this->db->prepare("UPDATE friends SET status = 'accepted' WHERE user_id = ? AND friend_id = ?");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function rejectRequest($userId, $friendId)
    {
        // Update the status to 'rejected'
        $stmt = $this->db->prepare("UPDATE friends SET status = 'rejected' WHERE user_id = ? AND friend_id = ?");
        $stmt->bind_param('ii', $userId, $friendId);
        $stmt->execute();
    }

    public function getFriends($userId)
    {
        // Get all accepted friends for the user
        $stmt = $this->db->prepare("SELECT u.id, u.username 
                                    FROM users u
                                    JOIN friends f ON (f.user_id = u.id OR f.friend_id = u.id)
                                    WHERE (f.user_id = ? OR f.friend_id = ?) AND f.status = 'accepted'");
        $stmt->bind_param('ii', $userId, $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
