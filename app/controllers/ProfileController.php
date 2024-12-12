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
        
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }

        $user_id = Session::get('user_id');
        
        $user = new User();
        $profile = new UserProfile();

        $userData = $user->getProfile($user_id);
        $profileData = $profile->getProfileByUserId($user_id);
        $totalThreads = $profile->getTotalThreads($user_id);

        
        $data = [
            'userData' => $userData,
            'profileData' => $profileData,
            'totalThreads' => $totalThreads
        ];

        
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

        require_once __DIR__ . '/../views/profile/editProfile.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
    
            $user = new User();
    
            try {
                $user->updateProfile($userId, $username, $email);
    
                if (!empty($currentPassword) && !empty($newPassword)) {
                    $user->updatePassword($userId, $currentPassword, $newPassword);
                }
    
                header('Location: /profile/view');
                exit;
            } catch (\Exception $e) {
                $error = $e->getMessage();
                
                $userData = $user->getProfile($userId);
                View::render('/profile/edit', compact('error', 'userData'));
                return;
            }
        }
    
        
        $userId = $_SESSION['user_id'];
        $user = new User();
        $userData = $user->getProfile($userId);
        View::render('profile/edit', compact('userData'));
    }
    

    public function uploadPhoto()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $profile_image = $_FILES['profile_image'];
        if ($profile_image && $profile_image['error'] == 0) {
            $uploadDir = 'uploads/profile/';
            $fileName = uniqid() . '-' . basename($profile_image['name']);
            $filePath = $uploadDir . $fileName;
            move_uploaded_file($profile_image['tmp_name'], $filePath);


            $user = new User();
            $user->updateProfilePicture(Session::get('user_id'), $fileName); 

            $_SESSION['success'] = 'Profile photo updated successfully.';
            header('Location: /profile/view');
            exit;
        }
    }

    View::render('profile/uploadPhoto');
}

public function removePhoto()
{
    $user = new User();
    $user->removeProfilePicture(Session::get('user_id'));

    $_SESSION['success'] = 'Profile photo removed successfully.';
    header('Location: /profile/view');
}

}
