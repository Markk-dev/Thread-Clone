<?php

namespace App\Core;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);   
      
        $layoutPath = BASE_PATH . "/app/views/layouts/main.php";
        
        if (file_exists($layoutPath)) {
            ob_start();
            
            $viewPath = BASE_PATH . "/app/views/{$view}.php";
            
            if (file_exists($viewPath)) {
                require_once $viewPath;
            } else {
                echo "View {$view} not found!";
            }
            
            $content = ob_get_clean();
            
            require_once $layoutPath;
        } else {
            echo "Layout not found! Path: {$layoutPath}";
        }
    }
}
