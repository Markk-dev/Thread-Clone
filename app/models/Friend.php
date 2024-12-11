<?php

namespace App\Models;

use App\Core\Model;

class Friend extends Model
{
    public function sendRequest($friendId)
{
    $userId = $_SESSION['user_id'];  
    
    
    $stmt = $this->db->prepare("INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param('ii', $userId, $friendId);
    $stmt->execute();
    
    
    if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        echo json_encode(['status' => 'success']);
        exit;
    }
    
    header('Location: /profile/' . $friendId);
    exit;
}


public function acceptRequest($friendId)

{
    error_log("Accepting friend request for friend ID: " . $friendId);
    // Update the status to 'accepted' for the given user and friend
    $stmt = $this->db->prepare("UPDATE friends SET status = 'accepted' WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
    $stmt->bind_param('iiii', $userId, $friendId, $friendId, $userId); // Bind both user-to-friend and friend-to-user
    $stmt->execute();
}

public function rejectRequest($friendId)
{
    error_log("Rejecting friend request for friend ID: " . $friendId);
    // Update the status to 'rejected'
    $stmt = $this->db->prepare("UPDATE friends SET status = 'rejected' WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
    $stmt->bind_param('iiii', $userId, $friendId, $friendId, $userId); // Bind both user-to-friend and friend-to-user
    $stmt->execute();
}


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
    

    public function getFriendRequests($userId)
{
    // Get all pending friend requests for the user
    $stmt = $this->db->prepare("SELECT u.id, u.username
                                FROM users u
                                JOIN friends f ON f.user_id = u.id
                                WHERE f.friend_id = ? AND f.status = 'pending'");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

    

}
