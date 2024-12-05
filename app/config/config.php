<?php

namespace App\Config;

class config
{
    public static $environment = 'development'; 
    public static $session_lifetime = 3600; 

    public static function get($key)
    {
        return self::$$key ?? null;
    }
}
