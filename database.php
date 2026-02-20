<?php
function getConnection(): PDO
{
    $databaseUrl = 'postgresql://postgres:[YOUR-PASSWORD]@db.qsaplxmltitmseqtnvue.supabase.co:5432/postgres';
    
    $pdo = new PDO($databaseUrl);
    
    return $pdo;
}