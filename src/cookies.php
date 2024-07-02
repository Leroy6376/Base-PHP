<?php

function setEmailCookie($email): void
{
    setcookie('email', $email, [
        'expires' => time() + 3600 * 24 * 30,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
}

function isSetEmailCookie(): bool
{
    return (bool) ($_COOKIE['email'] ?? false);
}
