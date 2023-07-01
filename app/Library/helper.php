<?php

use Illuminate\Support\Str;

function generateRandomUsername($length = 8)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    $username = '';

    for ($i = 0; $i < $length; $i++) {
        $randomChar = $characters[rand(0, strlen($characters) - 1)];
        $username .= $randomChar;
    }

    return $username;
}
