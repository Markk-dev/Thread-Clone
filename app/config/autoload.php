<?php

spl_autoload_register(function ($class) {
    
    $classPath = str_replace('\\', '/', $class) . '.php';
    
    $baseDir = __DIR__ . '/../';
    
    $filePath = $baseDir . $classPath;

    if (file_exists($filePath)) {
        require_once $filePath;
    } else {   
        
        echo "Class file not found: " . $filePath;
    }
});


use App\Config\Database;
$database = new Database();
$conn = $database->getConnection();
