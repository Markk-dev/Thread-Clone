<?php

namespace App\Core;

class Controller
{
    protected function render($view, $data = [])
    {
        View::render($view, $data);
    }
} 