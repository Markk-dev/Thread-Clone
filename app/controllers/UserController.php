<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Friend;
use App\Core\Controller;
use App\Core\View;
use App\Models\UserProfile;


class UserController extends Controller
{
    private $userProfileModel;
    public function __construct()
    {
        $this->userProfileModel = new UserProfile();
    }
    public function profile($userId)
    {
        
        $user = new User();
        $userData = $user->getProfile($userId);

        
        View::render('user/profile', compact('userData'));
    }

    public function showUserProfile($userId)
    {
        
        $profile = $this->userProfileModel->getProfileByUserId($userId);
        
        
        $totalThreads = $this->userProfileModel->getTotalThreads($userId);

        
        return [
            'profile' => $profile,
            'totalThreads' => $totalThreads
        ];
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

        $userData = $userModel->getUserById($userId);
        $threads = $threadModel->getThreadsByUserId($userId);
    
        
        View::render('friends/profile', [ 
            'userData' => $userData,
            'threads' => $threads,
            'currentUserId' => $_SESSION['user_id']
        ]);
    }
 
}
