<?php
function getConnection(): PDO
{
    $databaseUrl = 'postgresql://postgres:iv8ZhBSBm2xggGVO@db.qsaplxmltitmseqtnvue.supabase.co:5432/postgres';
    
    $pdo = new PDO($databaseUrl);
    
    return $pdo;
}