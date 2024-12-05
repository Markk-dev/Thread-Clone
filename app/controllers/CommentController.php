<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
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



    public function delete()
    {
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        
        $comment_id = $_GET['comment_id'];

        
        $commentModel = new Comment();
        $commentModel->deleteComment($comment_id);

        $_SESSION['success'] = 'Comment deleted successfully.';
        header('Location: /home');
    }

    public function like($commentId)
    {
        $userId = Session::get('user_id');
        $commentLikeModel = new CommentLike();

        if (!$commentLikeModel->userHasLiked($commentId, $userId)) {
            $commentLikeModel->likeComment($commentId, $userId);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function unlike($commentId)
    {
        $userId = Session::get('user_id');
        $commentLikeModel = new CommentLike();

        if ($commentLikeModel->userHasLiked($commentId, $userId)) {
            $commentLikeModel->unlikeComment($commentId, $userId);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
