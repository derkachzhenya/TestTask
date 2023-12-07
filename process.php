<?php
require_once 'db.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'create':
            createRecord();
            break;
        case 'update':
            updateRecord();
            break;
        default:
            echo 'Invalid action.';
    }
} else {
    echo 'No action specified.';
}

function createRecord() {
    global $pdo;

    $name = $_POST['name'];
    $title = $_POST['title'];

    try {
        $query = "INSERT INTO users (name, title) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $title]);

        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function updateRecord() {
    global $pdo;

    $id = $_POST['id'];
    $name = $_POST['name'];
    $title = $_POST['title'];

    try {
        $query = "UPDATE users SET name = ?, title = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $title, $id]);

        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
