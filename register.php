<?php
session_start();

require_once './utils/functions.php';
require_once './utils/queries.php';
require_once './utils/tests.php';

if (isConnected()) {
    header('Location: index.php');
    exit;
}

$error = null;
$success = null;

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($username) || empty($password)) {
        $error = 'Tous les champs sont obligatoires.';
    } elseif (!isEmailValid($email)) {
        $error = 'L\'adresse email n\'est pas valide.';
    } elseif (strlen($username) > 20) {
        $error = 'Le nom d\'utilisateur ne peut pas dépasser 20 caractères.';
    } elseif (!isPasswordStrong($password)) {
        $error = 'Le mot de passe doit contenir au moins 7 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
    } else {
        if (emailExists($email)) {
            $error = 'Cette adresse email est déjà utilisée.';
        } elseif (usernameExists($username)) {
            $error = 'Ce nom d\'utilisateur est déjà pris.';
        } else {
            createUser($username, $email, $password);
            $success = 'Inscription réussie ! Vous pouvez maintenant vous <a href="login.php">connecter</a>.';
        }
    }
}

$template = './templates/register.phtml';
include_once './templates/layout.phtml';
