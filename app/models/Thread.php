<?php
namespace App\Models;

use App\Core\Model;
use Exception;

class Thread extends Model
{
    public function create($userId, $content, $image = null, $video = null)
    {
        
        $stmt = $this->db->prepare("INSERT INTO threads (user_id, content, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param('is', $userId, $content);
        $stmt->execute();

        $threadId = $this->db->insert_id;

        
        if ($image) {
            $imagePath = $this->uploadFile($image, 'images');
            $this->insertContent($threadId, $imagePath, 'image');
        }

        if ($video) {
            $videoPath = $this->uploadFile($video, 'videos');
            $this->insertContent($threadId, $videoPath, 'video');
        }

        return $threadId;
    }

    public function getThreads()
{
    $stmt = $this->db->prepare("
        SELECT 
            t.id, 
            t.content, 
            t.created_at, 
            COUNT(h.id) AS hearts, 
            c.file_path AS image, 
            v.file_path AS video, 
            u.username, 
            u.profile_image
        FROM 
            threads t
        LEFT JOIN 
            hearts h ON h.thread_id = t.id
        LEFT JOIN 
            content c ON c.thread_id = t.id AND c.type = 'image'
        LEFT JOIN 
            content v ON v.thread_id = t.id AND v.type = 'video'
        LEFT JOIN 
            users u ON t.user_id = u.id
        GROUP BY 
            t.id
        ORDER BY 
            t.created_at DESC
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

    

    private function uploadFile($file, $type)
    {
        $targetDir = BASE_PATH . '/public/uploads/' . $type . '/';

        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . '-' . basename($file['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return 'uploads/' . $type . '/' . $fileName;
        }

        throw new \Exception('Failed to upload file: ' . $file['name']);
    }

    private function insertContent($threadId, $filePath, $type)
    {
        $stmt = $this->db->prepare("INSERT INTO content (thread_id, file_path, type) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $threadId, $filePath, $type);
        $stmt->execute();
    }

    public function getThreadById($threadId)
    {
        $stmt = $this->db->prepare("SELECT * FROM threads WHERE id = ?");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateThread($threadId, $content)
    {
        $stmt = $this->db->prepare("UPDATE threads SET content = ? WHERE id = ?");
        $stmt->bind_param('si', $content, $threadId);
        return $stmt->execute();
    }

   // In Thread.php Model

public function deleteThread($threadId)
{
    // Start the transaction
    $this->db->begin_transaction();

    try {
        // Step 1: Delete all comments related to the thread
        $stmt = $this->db->prepare("DELETE FROM comments WHERE thread_id = ?");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();

        // Step 2: Delete all content related to the thread
        $stmt = $this->db->prepare("DELETE FROM content WHERE thread_id = ?");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();

        // Step 3: Delete the thread itself
        $stmt = $this->db->prepare("DELETE FROM threads WHERE id = ?");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();

        // Commit the transaction if all deletes were successful
        $this->db->commit();

        // Return true if the thread and all related records are deleted
        return true;

    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $this->db->rollback();
        // Log the exception if necessary
        error_log($e->getMessage());
        return false;  // Something went wrong, deletion failed
    }
}



}
