<?php

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['DB_DSN', 'DB_USER', 'DB_PASS']);

try {
    $db = new PDO(getenv('DB_DSN'), getenv('DB_USER'), getenv('DB_PASS'));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}