<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProfileController;
use App\Controllers\ThreadController;
use App\Controllers\CommentController;

return [
    // Authentication routes
    '/' => [AuthController::class, 'login'],
    '/login' => [AuthController::class, 'login'],
    '/register' => [AuthController::class, 'register'],
    '/logout' => [AuthController::class, 'logout'],

    // Home routes
    '/auth/home' => [HomeController::class, 'index'],
    '/home' => [HomeController::class, 'index'],

    // Profile routes
    '/profile' => [ProfileController::class, 'edit'],
    '/update-profile' => [ProfileController::class, 'update'],

    // Thread routes
    '/thread/create' => [ThreadController::class, 'create'],
    '/save-thread' => [ThreadController::class, 'save'],
    
    // Comment routes
    '/add-comment' => [CommentController::class, 'add'],
    '/delete-comment' => [CommentController::class, 'delete'],

    '/heart-thread/{id}' => [ThreadController::class, 'heart'],
    '/thread/{id}/comment' => [ThreadController::class, 'comment'],

    // Like routes
    '/comment/{comment_id}/like' => [CommentController::class, 'like'],
    '/comment/{comment_id}/unlike' => [CommentController::class, 'unlike'],

    // Comment routes
    '/comments/{thread_id}' => [CommentController::class, 'getComments'],
];
