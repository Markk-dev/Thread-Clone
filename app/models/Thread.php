<?php
namespace App\Models;

use App\Core\Model;

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
            SELECT t.id, t.content, t.created_at, COUNT(h.id) AS hearts, c.file_path AS image
            FROM threads t
            LEFT JOIN hearts h ON h.thread_id = t.id
            LEFT JOIN content c ON c.thread_id = t.id AND c.type = 'image'
            GROUP BY t.id
            ORDER BY t.created_at DESC
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
}
