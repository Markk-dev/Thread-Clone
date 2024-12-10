<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Friend;
use App\Core\Controller;
use App\Core\View;

class UserController extends Controller
{
    public function profile($userId)
    {
        
        $user = new User();
        $userData = $user->getProfile($userId);

        
        View::render('user/profile', compact('userData'));
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $username = $_POST['username'];
            $email = $_POST['email'];

            
            $user = new User();
            $user->updateProfile($username, $email, $_SESSION['user_id']);

            
            header('Location: /profile/' . $_SESSION['user_id']);
            exit;
        }

        
        View::render('user/updateProfile');
    }

    
    public function viewProfile($userId)
    {
        $userModel = new User();
        $threadModel = new Thread();
        $friendModel = new Friend();
    
        
        $userData = $userModel->getUserById($userId);
        $threads = $threadModel->getThreadsByUserId($userId);
        $friends = $friendModel->getFriends($_SESSION['user_id']);
        $isFriend = in_array($userId, array_column($friends, 'id'));
    
        
        View::render('friends/profile', [ 
            'userData' => $userData,
            'threads' => $threads,
            'isFriend' => $isFriend,
            'currentUserId' => $_SESSION['user_id']
        ]);
    }
    
}
