<?php

namespace App\Controllers;

use App\Models\User;
use App\Config\Session;

class ProfileController
{
    public function edit()
    {
        
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        
        $user_id = Session::get('user_id');
        $user = new User();
        $userData = $user->getProfile($user_id);

        
        require_once 'views/profile/edit.php';
    }

    public function update()
    {
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }
    
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $profile_image = $_FILES['profile_image'] ?? null;
    
        
        if (empty($username) || empty($email)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: /profile');
            exit;
        }
    
        $image_path = null;
        
        if ($profile_image && $profile_image['error'] == 0) {
            $image_path = 'uploads/images/' . $profile_image['name'];
            move_uploaded_file($profile_image['tmp_name'], $image_path);
        }
    
        
        $user = new User();
        $user->updateProfile(Session::get('user_id'), $username, $email, $image_path);
    
        $_SESSION['success'] = 'Profile updated successfully.';
        header('Location: /profile');
    }
}
