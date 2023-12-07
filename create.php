<?php
// create.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];


    // Include the created_at column in the INSERT statement
    $stmt = $pdo->prepare('INSERT INTO users (name, title, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)');
    $stmt->execute([$name, $title]);

    header('Location: index.php');
    exit();
}
?>