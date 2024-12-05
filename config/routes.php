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
    '/home' => [HomeController::class, 'index'],

    // Profile routes
    '/profile' => [ProfileController::class, 'edit'],
    '/update-profile' => [ProfileController::class, 'update'],

    // Thread routes
    '/create-thread' => [ThreadController::class, 'create'],
    '/save-thread' => [ThreadController::class, 'save'],
    
    // Comment routes
    '/add-comment' => [CommentController::class, 'add'],
    '/delete-comment' => [CommentController::class, 'delete'],
];
