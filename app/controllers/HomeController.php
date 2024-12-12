<?php

namespace App\Controllers;

use App\Models\Thread;
use App\Config\Session;
use App\Core\View;
use App\Models\Heart;


class HomeController
{
    public function index()
    {
        
        if (!Session::get('user_id')) {
            header('Location: /login');
            exit;
        }
        
        $thread = new Thread();
        $threads = $thread->getThreads();

        $data = [
            'threads' => $threads,
            
            'comments' => $this->getComments(), 
        ];
  
        View::render('home/index', $data);
    }

    private function getComments()
    {
        
        return [];
    }
    
    

}
