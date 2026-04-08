<?php
session_start();

require_once __DIR__ . '/utils/functions.php';
require_once __DIR__ . '/utils/queries.php';

if (isConnected()) {
    header('Location: index.php');
    exit;
}

$error = null;

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'Tous les champs sont obligatoires.';
    } else {
        $user = getUserByEmail($email);

        if (!$user) {
            $error = 'Email ou mot de passe incorrect.';
        } elseif (!password_verify($password, $user['password'])) {
            $error = 'Email ou mot de passe incorrect.';
        } else {
            login($user);
            redirect('index.php');
        }
    }
}

$template = __DIR__ . '/templates/login.phtml';
include_once __DIR__ . '/templates/layout.phtml';
