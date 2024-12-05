<?php

namespace App\Config;

class config
{
    public static $environment = 'development'; // Set to 'production' for production environment
    public static $session_lifetime = 3600; // Set session lifetime to 1 hour (3600 seconds)

    public static function get($key)
    {
        return self::$$key ?? null;
    }
}
