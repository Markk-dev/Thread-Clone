<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Config\Session;

class CommentController
{
    public function add()
{
    if (!Session::get('user_id')) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    $thread_id = $_POST['thread_id'];
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'] ?? null;

    if (empty($content)) {
        echo json_encode(['success' => false, 'message' => 'Comment content cannot be empty']);
        exit;
    }

    $commentModel = new Comment();
    $commentModel->addComment($thread_id, Session::get('user_id'), $content, $parent_id);

    
    $comments = $commentModel->getComments($thread_id);

    echo json_encode(['success' => true, 'comments' => $comments]);
    exit;
}


public function getComments($threadId)
{
    $commentModel = new Comment();
    
    $comments = $commentModel->getCommentsByThread($threadId);

    
    $nestedComments = $this->buildNestedComments($comments);

    echo json_encode(['comments' => $nestedComments]);
    exit;
}


private function buildNestedComments($comments, $parentId = null)
{
    $nested = [];
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parentId) {
            $children = $this->buildNestedComments($comments, $comment['id']);
            if ($children) {
                $comment['replies'] = $children;
            }
            $nested[] = $comment;
        }
    }
    return $nested;
}
public function deleteComment()
{
   
    $data = json_decode(file_get_contents("php://input"), true);
    $commentId = $data['comment_id'];

    if (!$commentId) {
        echo json_encode(['success' => false, 'message' => 'No comment ID provided']);
        return;
    }

    $commentModel = new Comment();
    $deleteResult = $commentModel->deleteComment($commentId);

    if ($deleteResult) {
        echo json_encode(['success' => true, 'message' => 'Comment deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete comment']);
    }
}



}
