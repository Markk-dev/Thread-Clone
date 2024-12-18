<?php

namespace App\Models;

use App\Core\Model;
USE PDO;
class User extends Model
{
    public function register($username, $email, $password)
    {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid email format');
        }

        
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            throw new \Exception('Username or Email already exists');
        }

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $hashedPassword);
        $stmt->execute();

        return $this->db->insert_id;
    }

    public function login($emailOrUsername, $password)
    {
        
        $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param('ss', $emailOrUsername, $emailOrUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                return true;
            }
        }

        return false;
    }

    public function getProfile($userId)
    {
        $stmt = $this->db->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();

    }

        public function getProfilePictureAndUsername($userId)
    {
        $userModel = new User();
        $userData = $userModel->getUserById($userId);

        
        return [
            'username' => $userData['username'] ?? 'Unknown User',
            'profile_image' => $userData['profile_image'] ?? '/uploads/default/default.jpg',
        ];
    }


    public function updateProfile($userId, $username, $email, $profileImage = null)
    {
        if ($profileImage) {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, profile_image = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $email, $profileImage, $userId);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $email, $userId);
        }
        return $stmt->execute();
    }

    public function updateProfilePicture($userId, $filePath)
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
        $stmt->bind_param("si", $filePath, $userId);
        return $stmt->execute();
    }

    public function removeProfilePicture($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function updatePassword($userId, $currentPassword, $newPassword)
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!password_verify($currentPassword, $user['password'])) {
            throw new \Exception('Current password is incorrect.');
        }

        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedNewPassword, $userId);

        return $stmt->execute();
    }

    public function searchUsers($query)
    {
        $stmt = $this->db->prepare("SELECT id, username, profile_image FROM users WHERE username LIKE ? LIMIT 5");
        $searchTerm = "%{$query}%";
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        return $users;
    }

public function getThreadsByUserId($userId)
{
    $stmt = $this->db->prepare("SELECT * FROM threads WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


}
