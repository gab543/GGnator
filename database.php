<?php
function getConnection(): PDO
{
    $host = 'localhost';
    $dbName = 'ggnator';
    $username = 'root';
    $password = 'root';

    $pdo = new PDO(
        'mysql:host=' . $host . ';port=3306;dbname=' . $dbName . ';charset=utf8',
        $username,
        $password
    );

    return $pdo;
}

// var_dump(getConnection());