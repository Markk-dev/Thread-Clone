<?php

namespace App\Controllers;

use App\Models\Thread;
use App\Config\Session;
use App\Core\View;
use App\Models\Heart;


class HomeController
{
    public function index()
    {
        // Check if user is logged in
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        // Create a Thread model instance and get threads
        $thread = new Thread();
        $threads = $thread->getThreads();

        // Prepare any additional data needed for the view
        $data = [
            'threads' => $threads,
            // Ensure comments are fetched and passed if needed
            'comments' => $this->getComments(), // Example method to fetch comments
        ];

        // Load the feed view using the View class
        View::render('home/index', $data);
    }

    // Example method to fetch comments
    private function getComments()
    {
        // Fetch comments logic here
        return [];
    }
    
    public function add()
    {
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }
    
        $threadId = $_POST['thread_id'];
    
        // Increment heart count in the database
        $heartModel = new Heart();
        $heartModel->likeThread($threadId, Session::get('user_id'));
    
        // Get the updated heart count
        $hearts = $heartModel->countHearts($threadId);
    
        // Return a success response with the updated heart count
        echo json_encode(['success' => true, 'hearts' => $hearts]);
    }
    

}
