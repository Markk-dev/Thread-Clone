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
                return; // Stop execution if passwords don't match
            }

            
            $user = new User();
            $user->register($username, $email, $password);

            
            header('Location: /login');
            exit;
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
        
        session_start();
        session_destroy();

        
        header('Location: /login');
        exit;
    }
}
