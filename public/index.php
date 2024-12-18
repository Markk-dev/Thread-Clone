<?php
// public/index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BASE_PATH', realpath(__DIR__ . '/../'));

require_once __DIR__ . '/../vendor/autoload.php';
use App\Config\Session;
Session::start();
$routes = require __DIR__ . '/../app/config/routes.php';

$requestUri = $_SERVER['REQUEST_URI'];

foreach ($routes as $route => $handler) {
    $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route);
    if (preg_match('#^' . $pattern . '$#', $requestUri, $matches)) {
        array_shift($matches);
        $controller = new $handler[0]();
        $action = $handler[1];
        $controller->$action(...$matches);
        exit;
    }
}

// Default route handling if no match
\App\Config\Errors::handle404();
