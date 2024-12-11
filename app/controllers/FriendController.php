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
        
        error_log("Accepting friend request for friend ID: " . $friendId);
        $userId = $_SESSION['user_id']; 
        
        $friend = new Friend(); 
        $friend->acceptRequest($userId, $friendId); 

        
        header('Location: /friend/friendList');
        exit;
    }

    
    public function rejectRequest($friendId)
    {
        $userId = $_SESSION['user_id']; 
        
        $friend = new Friend(); 
        $friend->rejectRequest($userId, $friendId); 

        
        header('Location: /friend/friendList');
        exit;
    }


    
    public function friendList()
    {
        $userId = $_SESSION['user_id'];
    
        
        $friend = new Friend();
        $friends = $friend->getFriends($userId);
    
        
        $pendingRequests = $friend->getFriendRequests($userId);
    
        
        View::render('friends/friendList', compact('friends', 'pendingRequests'));
    }
    
    
    

    
    

}
