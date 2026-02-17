<?php

function isConnected()
{
    return isset($_SESSION['user']);
}

function login(array $user): void
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email']
    ];
}

function redirect($url): void
{
    header('Location: ' . $url);
    exit;
}

