<?php

namespace App\Controllers;

use App\Models\Thread;
use App\Models\Content;
use App\Models\Heart;
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

            // Thread creation logic (validate input and handle file upload)
            $thread = new Thread();
            $thread->create($userId, $content, $image, $video);

            // Redirect to home page after creating thread
            header('Location: /home');
            exit;
        }

        // Load the create thread view
        View::render('threads/create');
    }

    public function like($threadId)
    {
        $userId = $_SESSION['user_id'];

        // Like thread logic
        $heart = new Heart();
        $heart->likeThread($threadId, $userId);

        // Redirect to home page after liking the post
        header('Location: /home/index');
        exit;
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
        // Fetch threads sorted by hearts and creation date
        $thread = new Thread();
        $threads = $thread->getThreads();

        // Load the feed view
        View::render('home/feed', compact('threads'));
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? null;

            // Check and process image
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
            }

            // Check and process video
            $video = null;
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $video = $_FILES['video'];
            }

            // Ensure at least one of content, image, or video is provided
            if (empty($content) && !$image && !$video) {
                $_SESSION['error'] = 'Please provide content, an image, or a video.';
                header('Location: /thread/create');
                exit;
            }

            // Save the thread
            $threadModel = new Thread();
            $threadModel->create($_SESSION['user_id'], $content, $image, $video);

            header('Location: /home');
            exit;
        }
    }

    public function heart($threadId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];  // Ensure the user is logged in
    
            // Instantiate Heart model
            $heart = new Heart();
    
            // Increment heart count by inserting or updating in the hearts table
            $heart->likeThread($threadId, $userId);
    
            // Get the updated heart count
            $hearts = $heart->countHearts($threadId);
    
            // Return the updated heart count as a JSON response
            echo json_encode([
                'success' => true,
                'newHeartCount' => $hearts
            ]);
            exit;  // Make sure to stop the script after the response
        }
    }

    public function view($threadId)
    {
        // Fetch thread details
        $threadModel = new Thread();
        $thread = $threadModel->getThreadById($threadId);

        // Fetch comments for the thread
        $commentModel = new Comment();
        $comments = $commentModel->getComments($threadId);

        // Render the view with thread and comments
        View::render('threads/view', [
            'thread' => $thread,
            'comments' => $comments,
            'threadId' => $threadId
        ]);
    }
}
