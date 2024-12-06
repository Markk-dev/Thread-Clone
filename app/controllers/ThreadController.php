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

            $thread = new Thread();
            $thread->create($userId, $content, $image, $video);

            header('Location: /home');
            exit;
        }

        View::render('threads/create');
    }

    public function like($threadId)
    {
        $userId = $_SESSION['user_id'];

        $heart = new Heart();
        $heart->likeThread($threadId, $userId);

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
        $thread = new Thread();
        $threads = $thread->getThreads();

        View::render('home/feed', compact('threads'));
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

    public function heart($threadId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];  
    
            $heart = new Heart();
    
            $heart->likeThread($threadId, $userId);
    
            $hearts = $heart->countHearts($threadId);
    
            echo json_encode([
                'success' => true,
                'newHeartCount' => $hearts
            ]);
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
            // Redirect if the thread doesn't exist
            header('Location: /');
            exit;
        }
    
        // Load the edit thread page with thread data
        View::render('config/editThread', ['thread' => $thread]);
    }
    
    public function update($threadId)
    {
        // Get data from POST request
        $content = $_POST['content'] ?? null;
    
        // Validate the content
        if (empty($content)) {
            echo json_encode(['success' => false, 'message' => 'Content is required']);
            exit;
        }
    
        // Update the thread content
        $threadModel = new Thread();
        $result = $threadModel->updateThread($threadId, $content);
    
        if ($result) {
            header('Location: /home'); // Redirect to the thread view page
            exit;
        } else {
            // Handle error
            echo "Failed to update thread.";
            exit;
        }
    }
    

// In ThreadController.php

public function delete($threadId)
{
    // Instantiate the Thread model directly
    $threadModel = new Thread();

    // Attempt to delete the thread
    $deleted = $threadModel->deleteThread($threadId);

    // Check if deletion was successful
    if ($deleted) {
        // Redirect to a confirmation page or the thread list
        header('Location: /home');  // Redirect to threads list, for example
        exit();
    } else {
        // Handle error case (e.g., show an error message)
        echo "Error: Unable to delete thread";
    }
}



}
