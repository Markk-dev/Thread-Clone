<?php
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProfileController;
use App\Controllers\ThreadController;
use App\Controllers\CommentController;
use App\Controllers\UserController;
use App\Controllers\FriendController;
use App\Controllers\HeartController;


return [

    // Authentication 
    '/' => [AuthController::class, 'login'],
    '/login' => [AuthController::class, 'login'],
    '/register' => [AuthController::class, 'register'],
    '/logout' => [AuthController::class, 'logout'],

    // Home 
    '/auth/home' => [HomeController::class, 'index'],
    '/home' => [HomeController::class, 'index'],

    '/profile/view' => [ProfileController::class, 'view'],
    '/profile/edit' => [ProfileController::class, 'edit'],
    '/profile/update'  => [ProfileController::class, 'update'],

    // Thread 
    '/thread/create' => [ThreadController::class, 'create'],
    '/save-thread' => [ThreadController::class, 'save'],
    
    // Comment 
    '/add-comment' => [CommentController::class, 'add'],
    '/delete-comment' => [CommentController::class, 'delete'],
    '/comments/{thread_id}' => [CommentController::class, 'getComments'],

   '/heart-thread/{id}' => [HeartController::class, 'toggleHeart', 'methods' => ['POST']],
    '/thread/{id}/comment' => [ThreadController::class, 'comment'],

    // Like 
    '/comment/{comment_id}/like' => [CommentController::class, 'like'],
    '/comment/{comment_id}/unlike' => [CommentController::class, 'unlike'],

   
    // Edit 
    '/thread/edit/{id}' => [ThreadController::class, 'edit'],

    // Delete 
    '/thread/delete/{id}' => [ThreadController::class, 'delete'],

    // Update
    '/thread/update/{id}' => [ThreadController::class, 'update'],

    //Profile
    '/profile/upload-photo' => [ProfileController::class, 'uploadPhoto'],
    '/profile/remove-photo' => [ProfileController::class, 'removePhoto'],
    '/profile/{userId}' => [UserController::class, 'viewProfile'],

    //Friend
    // '/friend/sendRequest/{userId}' => [FriendController::class, 'sendRequest'],
    // '/friend/friendList' => [FriendController::class, 'friendList'],
    // '/friend/acceptRequest/(:num)' => [FriendController::class, 'acceptRequest'],
    // '/friend/rejectRequest/(:num)' => [FriendController::class, 'rejectRequest'],

    '/logout' => [AuthController::class, 'logout'],
];

