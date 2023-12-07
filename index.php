<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD App</title>
</head>

<body>


    <div class="container">
        <h2>CRUD App</h2>

        <form action="create.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <button type="submit">Create</button>

        </form>

        <h3>Tasks:</h3>
        <ul>
            <?php
            require_once 'db.php';

            try {
                $query = "SELECT * FROM users";
                $stmt = $pdo->query($query);

                if ($stmt->rowCount() > 0) {
                    echo '<ul>';
                    echo '    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>';

                    while ($row = $stmt->fetch()) {
                        echo '<tbody>
                            <tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['title'] . '</td>
                                <td>' . $row['created_at'] . '</td>
                                <td>' . $row['updated_at'] . '</td>
                                <td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>
                                <td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>
                            </tr>
                        </tbody>';
                    }
                    echo '</table>';
                    echo '</ul>';
                } else {
                    echo 'No users found.';
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>

        </ul>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function updateTable() {
            // Fetch updated data using AJAX
            $.ajax({
                url: 'update_table.php', // Replace with the script that fetches the updated data
                method: 'GET',
                success: function(data) {
                    // Replace the content of the table with the updated data
                    $('#userTable').html(data);
                },
                error: function(error) {
                    console.error('Error fetching updated data:', error);
                }
            });
        }
    </script>

</body>

</html>