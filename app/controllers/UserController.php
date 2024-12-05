<?php

namespace App\Controllers;

use App\Models\User;
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
}
