<?php

namespace App\Models;

use App\Core\Model;

class Comment extends Model
{
    public function addComment($threadId, $userId, $content, $parentId = null)
    {
        $stmt = $this->db->prepare("INSERT INTO comments (thread_id, user_id, content, parent_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iisi', $threadId, $userId, $content, $parentId);
        $stmt->execute();

        
        if ($stmt->error) {
            error_log("SQL Error: " . $stmt->error);
        }
    }

    public function getComments($threadId)
    {
        $stmt = $this->db->prepare("
            SELECT c.id, c.content, c.created_at, u.username, 
                IFNULL(u.profile_image, '/uploads/default/default.jpg') AS profile_image, 
                c.parent_id
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.thread_id = ?
            ORDER BY c.created_at ASC

        ");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getCommentsByThread($threadId)
    {
        $stmt = $this->db->prepare("
            SELECT c.id, c.content, c.created_at, u.username, u.profile_image, c.parent_id
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.thread_id = ?
            ORDER BY c.created_at ASC
        ");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

public function deleteComment($commentId)
    {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
    }
}
