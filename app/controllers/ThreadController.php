<?php

namespace App\Controllers;

use App\Models\Thread;
use App\Models\Content;
use App\Models\Heart;
use App\Models\User;
use App\Models\Comment;
use App\Core\Controller;
use App\Core\View;


class ThreadController extends Controller
{   
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $content = $_POST['content'];
            $image = $_FILES['image'] ?? null;
            $video = $_FILES['video'] ?? null;

            $threadModel = new Thread();
            $threadModel->create($userId, $content, $image, $video);

            header('Location: /home');
            exit;
        }

        
        $userData = $this->getUserData($_SESSION['user_id']);

        View::render('threads/create', ['userData' => $userData]);
    }

    private function getUserData($userId)
    {
        $userModel = new User();
        $user = $userModel->getUserById($userId);

        return [
            'username' => $user['username'] ?? 'Unknown User',
            'profile_image' => $user['profile_image'] ?? '/uploads/default/default.jpg',
        ];
    }

    public function comment($threadId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $content = $_POST['content'];
            $parentId = $_POST['parent_id'] ?? null;

            $commentModel = new Comment();
            $commentModel->addComment($threadId, $userId, $content, $parentId);

            header('Location: /thread/' . $threadId);
            exit;
        }

        $commentModel = new Comment();
        $comments = $commentModel->getComments($threadId);

        View::render('threads/comments', ['comments' => $comments, 'threadId' => $threadId]);
    }

        public function feed()
    {
        $threadModel = new Thread();
        $threads = $threadModel->getThreads();
        $userId = $_SESSION['user_id'];

        View::render('home/feed', compact('threads', 'userId'));
    }


    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? null;

            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
            }

            $video = null;
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $video = $_FILES['video'];
            }

            if (empty($content) && !$image && !$video) {
                $_SESSION['error'] = 'Please provide content, an image, or a video.';
                header('Location: /thread/create');
                exit;
            }

            $threadModel = new Thread();
            $threadModel->create($_SESSION['user_id'], $content, $image, $video);

            header('Location: /home');
            exit;
        }
    }



    public function view($threadId)
    {
        $threadModel = new Thread();
        $thread = $threadModel->getThreadById($threadId);

        $commentModel = new Comment();
        $comments = $commentModel->getComments($threadId);

        View::render('threads/view', [
            'thread' => $thread,
            'comments' => $comments,
            'threadId' => $threadId
        ]);
    }

    public function edit($threadId)
    {
        $threadModel = new Thread();
        $thread = $threadModel->getThreadById($threadId);
        
        if (!$thread) {
            
            header('Location: /');
            exit;
        }
    
        
        View::render('config/editThread', ['thread' => $thread]);
    }
    
    public function update($threadId, $message = 'An error occurred during the update.')
    {
        $content = $_POST['content'] ?? null;
    
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
        }
    
        $video = null;
        if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            $video = $_FILES['video'];
        }
    
        
        if (empty($content) && !$image && !$video) {
            header('Location: /home');
            return;
        }
    
        $threadModel = new Thread();
        $result = $threadModel->updateThread($threadId, $content, $image, $video);
    
        if ($result) {
            header('Location: /home');
            exit;
        } else {
            header('Location: /home');
        }
    }
    
    


public function delete($threadId)
{
    
    $threadModel = new Thread();

    
    $deleted = $threadModel->deleteThread($threadId);

    
    if ($deleted) {
        
        header('Location: /home');  
        exit();
    } else {
        
        echo "Error: Unable to delete thread";
    }
}


public function isThreadOwner($threadId)
{
    $threadModel = new Thread();
    $thread = $threadModel->getThreadById($threadId);

    return $thread && $thread['user_id'] == $_SESSION['user_id'];
}

}
