<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Config\Session;
use App\Core\View;

class ProfileController
{
    public function view()
    {
        // Ensure the user is logged in
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        $user_id = Session::get('user_id');

        // Fetch user and profile data
        $user = new User();
        $profile = new UserProfile();

        $userData = $user->getProfile($user_id);
        $profileData = $profile->getProfileByUserId($user_id);
        $totalThreads = $profile->getTotalThreads($user_id);

        // Prepare data for the view
        $data = [
            'userData' => $userData,
            'profileData' => $profileData,
            'totalThreads' => $totalThreads
        ];

        // Render the profile view inside the main layout
        View::render('profile/view', $data);
    }

    public function edit()
    {
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        $user_id = Session::get('user_id');
        $user = new User();
        $userData = $user->getProfile($user_id);

        require_once 'views/profile/editProfile.php';
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

        // Validate input
        if (empty($username) || empty($email)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: /profile/edit');
            exit;
        }

        $image_path = null;
        if ($profile_image && $profile_image['error'] == 0) {
            $image_path = 'uploads/images/' . $profile_image['name'];
            move_uploaded_file($profile_image['tmp_name'], $image_path);
        }

        // Update profile
        $user = new User();
        $user->updateProfile(Session::get('user_id'), $username, $email, $image_path);

        $_SESSION['success'] = 'Profile updated successfully.';
        header('Location: /profile');
    }
}
