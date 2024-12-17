<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;
use App\Core\View;

class AuthController extends Controller
{
    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
            View::render('auth/register', compact('error'));
            return;
        }

          
          if (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters long.';
            View::render('auth/register', compact('error'));
            return;
        }

        $user = new User();

        try {
            // Attempt to register the user
            $user->register($username, $email, $password);
            header('Location: /login');
            exit;
        } catch (\Exception $e) {
            // Catch any exception (like username or email already exists) and pass the error to the view
            $error = $e->getMessage();
            View::render('auth/register', compact('error'));
            return;
        }
    }

    View::render('auth/register');
}

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailOrUsername = $_POST['email_or_username'];
            $password = $_POST['password'];
    
            $user = new User();
            if ($user->login($emailOrUsername, $password)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['logged_in'] = true;
    
                header('Location: /home');
                exit;
            } else {
                $error = 'Invalid credentials';
                View::render('auth/login', compact('error'));
            }
        }
    
        View::render('auth/login');
    }
    

   public function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();

    header('Location: /login');
    exit;
}
    
    
}
