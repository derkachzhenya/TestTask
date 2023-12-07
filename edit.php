<?php
require_once 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
        } else {
            echo 'User not found.';
            exit();
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
} else {
    echo 'Invalid request.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Task</title>
</head>
<body>

<div class="container">
    <h2>Edit Task</h2>

    <!-- Form for editing a record -->
    <form action="process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $user['title']; ?>" required>
        
        <button type="submit" name="action" value="update">Update</button>
    </form>
</div>

</body>
</html>
