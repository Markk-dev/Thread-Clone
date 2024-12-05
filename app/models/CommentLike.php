<?php

namespace App\Models;

use App\Core\Model;

class CommentLike extends Model
{
    public function likeComment($commentId, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO comment_likes (comment_id, user_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $commentId, $userId);
        $stmt->execute();
    }

    public function unlikeComment($commentId, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM comment_likes WHERE comment_id = ? AND user_id = ?");
        $stmt->bind_param('ii', $commentId, $userId);
        $stmt->execute();
    }

    public function countLikes($commentId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as like_count FROM comment_likes WHERE comment_id = ?");
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['like_count'];
    }

    public function userHasLiked($commentId, $userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM comment_likes WHERE comment_id = ? AND user_id = ?");
        $stmt->bind_param('ii', $commentId, $userId);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
} 