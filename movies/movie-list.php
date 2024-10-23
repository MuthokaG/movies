<?php
$hn = 'localhost';
$db = 'movie';
$un = 'root';
$pw = '';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query("SELECT * FROM movies");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        /* Add some styling for buttons */
        .btn {
            padding: 5px 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 5px;
            text-decoration: none;
        }

        .btn-update {
            background-color: #f0ad4e; /* Orange for update */
        }

        .btn-delete {
            background-color: #d9534f; /* Red for delete */
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Cinemark</h1>
        <a href="movie-list.php">Home</a>
        <a href="movie-add.php" class="right">Add Movie</a>
    </div>

    <div class="container">
        <h1>Movie List</h1>
        <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Director</th>
            <th>Release Year</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['director'] ?></td>
            <td><?= $row['release_year'] ?></td>
            <td><?= $row['genre'] ?></td>
            <td>
                <!-- Details Button -->
                <form action="movie-details.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn">Details</button>
                </form>

                <!-- Update Button -->
                <form action="movie-update.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-update">Update</button>
                </form>

                <!-- Delete Button -->
                <form action="movie-delete.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>