<?php

namespace App\Config;

class errors
{
    public static function handle404()
    {
        http_response_code(404);
        echo "404 Not Found";
    }
    public static function handle500()
    {
        http_response_code(500);
        echo "500 Internal Server Error";
    }
}
