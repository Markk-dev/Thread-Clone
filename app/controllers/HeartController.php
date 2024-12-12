<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Heart;

class HeartController extends Controller
{
    public function toggleHeart($threadId)
    {
        $userId = $_SESSION['user_id'];
        $heartModel = new Heart();
    
        $status = $heartModel->toggleHeart($threadId, $userId);
        $heartCount = $heartModel->countHearts($threadId);
    
        echo json_encode([
            'success' => true,
            'status' => $status,
            'heartCount' => $heartCount
        ]);
        exit;
    }
}
