<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;
use App\Core\View;

class UserController extends Controller
{
    public function profile($userId)
    {
        // Fetch user data using the User model
        $user = new User();
        $userData = $user->getProfile($userId);

        // Load the profile view
        View::render('user/profile', compact('userData'));
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update profile (e.g., username, email, profile image, etc.)
            $username = $_POST['username'];
            $email = $_POST['email'];

            // Profile update logic (check if values are valid)
            $user = new User();
            $user->updateProfile($username, $email, $_SESSION['user_id']);

            // Redirect to updated profile page
            header('Location: /profile/' . $_SESSION['user_id']);
            exit;
        }

        // Load profile update view
        View::render('user/updateProfile');
    }
}
