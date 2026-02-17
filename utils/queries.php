<?php

require_once './database.php';

// User queries
function getUserByEmail($email)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE LOWER(email) = LOWER(:email)');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserById($id)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function emailExists($email)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT id FROM users WHERE LOWER(email) = LOWER(:email)');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch() !== false;
}

function usernameExists($username)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT id FROM users WHERE LOWER(username) = LOWER(:username)');
    $stmt->execute(['username' => $username]);
    return $stmt->fetch() !== false;
}

function createUser($username, $email, $password)
{
    $pdo = getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        'INSERT INTO users (username, email, password, register_date) VALUES (:username, :email, :password, :register_date)'
    );
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'register_date' => date('Y-m-d')
    ]);
    return $pdo->lastInsertId();
}

// Quiz queries
function getFirstQuestion()
{
    $pdo = getConnection();
    $stmt = $pdo->query('SELECT * FROM questions WHERE is_first = 1 LIMIT 1');
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getQuestionById($id)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM questions WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getResponse($questionId, $answer)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM response WHERE question_id = ? AND content = ?');
    $stmt->execute([$questionId, $answer]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getResultById($id)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('SELECT * FROM result WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function saveGame($userId, $resultId)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('INSERT INTO game (user_id, result_id) VALUES (?, ?)');
    $stmt->execute([$userId, $resultId]);
}

function getUserGames($userId)
{
    $pdo = getConnection();
    $stmt = $pdo->prepare('
        SELECT g.*, r.name as result_name, r.description as result_description, r.image as result_image 
        FROM game g 
        JOIN result r ON g.result_id = r.id 
        WHERE g.user_id = ? 
        ORDER BY g.date DESC
    ');
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
