<?php

namespace App\Controllers;

use App\Models\User;
use App\Config\Session;

class ProfileController
{
    public function edit()
    {
        // Check if user is logged in
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        // Get the logged-in user's details
        $user_id = Session::get('user_id');
        $user = new User();
        $userData = $user->getProfile($user_id);

        // Load the profile edit view
        require_once 'views/profile/edit.php';
    }

    public function update()
    {
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }
    
        // Get user input
        $username = $_POST['username'];
        $email = $_POST['email'];
        $profile_image = $_FILES['profile_image'] ?? null;
    
        // Validate inputs
        if (empty($username) || empty($email)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: /profile');
            exit;
        }
    
        $image_path = null;
        // Process the profile image if uploaded
        if ($profile_image && $profile_image['error'] == 0) {
            $image_path = 'uploads/images/' . $profile_image['name'];
            move_uploaded_file($profile_image['tmp_name'], $image_path);
        }
    
        // Update the user's details in the database
        $user = new User();
        $user->updateProfile(Session::get('user_id'), $username, $email, $image_path);
    
        $_SESSION['success'] = 'Profile updated successfully.';
        header('Location: /profile');
    }
}
