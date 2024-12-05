<?php

namespace App\Models;

use App\Core\Model;

class Content extends Model
{
    public function getContent($threadId)
    {
        $stmt = $this->db->prepare("SELECT * FROM content WHERE thread_id = ?");
        $stmt->bind_param('i', $threadId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
