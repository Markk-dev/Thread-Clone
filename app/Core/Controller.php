<?php

namespace App\Core;

class Controller
{
    // Base controller functionality can be added here
    protected function render($view, $data = [])
    {
        View::render($view, $data);
    }
} 