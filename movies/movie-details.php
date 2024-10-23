<?php
$hn = 'localhost';
$db = 'movie';
$un = 'root';
$pw = '';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Details</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .btn {
            padding: 5px 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-update {
            background-color: #f0ad4e; /* Orange for update */
        }

        .btn-back {
            background-color: #5bc0de; /* Blue for back */
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Cinemark</h1>
        <a href="movie-list.php">Home</a>
    </div>

    <div class="container">
        <h1>Movie Details</h1>
        <p><strong>Title:</strong> <?= $movie['title'] ?></p>
        <p><strong>Director:</strong> <?= $movie['director'] ?></p>
        <p><strong>Release Year:</strong> <?= $movie['release_year'] ?></p>
        <p><strong>Genre:</strong> <?= $movie['genre'] ?></p>
        <form action="movie-list.php" method="GET" style="display:inline;">
        <button type="submit" class="btn btn-back">Back to List</button>
    </form>
    </div>
    <!-- Button to update the movie -->
    <form action="movie-update.php" method="GET" style="display:inline;">
        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
        <button type="submit" class="btn btn-update">Update Movie</button>
    </form>
</body>
</html>