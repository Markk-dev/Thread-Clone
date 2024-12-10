<?php

namespace App\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\Core\Controller;
use App\Core\View;

class FriendController extends Controller
{
    public function sendRequest($friendId)
    {
        $userId = $_SESSION['user_id'];
        $friend = new Friend();
        $friend->sendRequest($userId, $friendId);
        header('Location: /profile/' . $friendId);
        exit;
    }

    public function acceptRequest($friendId)
    {
        $userId = $_SESSION['user_id'];

        
        $friend = new Friend();
        $friend->acceptRequest($userId, $friendId);

        
        header('Location: /home');
        exit;
    }

    public function rejectRequest($friendId)
    {
        $userId = $_SESSION['user_id'];

        
        $friend = new Friend();
        $friend->rejectRequest($userId, $friendId);

        
        header('Location: /home');
        exit;
    }

    public function friendsList()
    {
        $userId = $_SESSION['user_id'];

        
        $friend = new Friend();
        $friends = $friend->getFriends($userId);

        
        View::render('user/friends', compact('friends'));
    }
}
