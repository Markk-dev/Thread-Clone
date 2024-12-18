<?php

namespace App;

use App\Components\ErrorHandler;

class FormHandler
{
    public function handleLogin($postData)
    {
        if (empty($postData['email_or_username']) || empty($postData['password'])) {
            ErrorHandler::displayError("Both fields are required.");
            return false;
        }

        $username = $postData['email_or_username'];
        $password = $postData['password'];

        if ($username !== 'Vander' || $password !== 'Admin1') {
            ErrorHandler::displayError("Invalid username or password.");
            return false;
        }

        return true;
    }

    public function handleRegister($postData)
    {
        if (empty($postData['username']) || empty($postData['email']) || empty($postData['password'])) {
            ErrorHandler::displayError("All fields are required.");
            return false;
        }

        if ($this->isUsernameTaken($postData['username'])) {
            ErrorHandler::displayError("Username is already taken.");
            return false;
        }

        if ($this->isEmailTaken($postData['email'])) {
            ErrorHandler::displayError("Email is already registered.");
            return false;
        }

        if ($this->containsNumbers($postData['username'])) {
            ErrorHandler::displayError("Username should not contain numbers.");
            return false;
        }

        if (strlen($postData['password']) < 6) {
            ErrorHandler::displayError("Password must be at least 6 characters.");
            return false;
        }

        if (!$this->isValidGmail($postData['email'])) {
            ErrorHandler::displayError("Please enter a valid Gmail address (e.g., user@gmail.com).");
            return false;
        }

        return true;
    }

    private function isUsernameTaken($username)
    {
        $existingUsernames = ['admin', 'johnDoe'];
        return in_array($username, $existingUsernames);
    }

    private function isEmailTaken($email)
    {
        $existingEmails = ['admin@example.com', 'john.doe@example.com'];
        return in_array($email, $existingEmails);
    }

    private function isValidGmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@gmail.com') !== false;
    }

    private function containsNumbers($str)
    {
        return preg_match('/\d/', $str);
    }
}

include_once __DIR__ . '/ErrorHandler.php'; // Adjust the path if necessary
