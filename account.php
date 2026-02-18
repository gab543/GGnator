<?php
session_start();

require_once './utils/functions.php';
require_once './utils/tests.php';
require_once './utils/queries.php';

if (!isConnected()) {
    redirect('login.php');
}

$userId = $_SESSION['user']['id'];
$games = getUserGames($userId);
$stats = getGameStats($userId);
$error = null;

// Calculer le taux de réussite
$totalGames = (int) $stats['total_games'];
$wonGames = (int) ($stats['won_games'] ?? 0);
$winRate = $totalGames > 0 ? round(($wonGames / $totalGames) * 100, 2) : 0;


try {
    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        if (!isPasswordStrong($newPassword)) {
            $error = 'Le nouveau mot de passe doit comporter au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
        } else {
            $user = getUserById($userId);
            if (password_verify($currentPassword, $user['password'])) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $pdo = getConnection();
                $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
                $stmt->execute([$hashedNewPassword, $userId]);
            }
        }
    }
} catch (Exception $e) {
    $error = 'Une erreur est survenue lors de la mise à jour du mot de passe.';
}


try {
    if (isset($_POST['delete_account'])) {
        $pdo = getConnection();

        $stmt = $pdo->prepare('DELETE FROM game WHERE user_id = ?');
        $stmt->execute([$userId]);

        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        redirect('logout.php');
    }
} catch (Exception $e) {
    $error = 'Une erreur est survenue lors de la suppression du compte.';
}

$template = './templates/account.phtml';
include_once './templates/layout.phtml';