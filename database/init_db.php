<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `db_ulamsari` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "DB_OK\n";
} catch (Exception $e) {
    echo "DB_ERR: " . $e->getMessage() . "\n";
}
