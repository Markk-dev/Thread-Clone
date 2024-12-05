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

        // Send friend request logic
        $friend = new Friend();
        $friend->sendRequest($userId, $friendId);

        // Redirect to the user's profile after sending request
        header('Location: /profile/' . $friendId);
        exit;
    }

    public function acceptRequest($friendId)
    {
        $userId = $_SESSION['user_id'];

        // Accept friend request logic
        $friend = new Friend();
        $friend->acceptRequest($userId, $friendId);

        // Redirect to the home page after accepting
        header('Location: /home');
        exit;
    }

    public function rejectRequest($friendId)
    {
        $userId = $_SESSION['user_id'];

        // Reject friend request logic
        $friend = new Friend();
        $friend->rejectRequest($userId, $friendId);

        // Redirect to the home page after rejecting
        header('Location: /home');
        exit;
    }

    public function friendsList()
    {
        $userId = $_SESSION['user_id'];

        // Fetch list of friends
        $friend = new Friend();
        $friends = $friend->getFriends($userId);

        // Load the friends list view
        View::render('user/friends', compact('friends'));
    }
}
