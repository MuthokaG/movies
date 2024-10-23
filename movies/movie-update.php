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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];

    $stmt = $conn->prepare("UPDATE movies SET title = ?, director = ?, release_year = ?, genre = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $title, $director, $release_year, $genre, $id);
    $stmt->execute();

    header("Location: movie-list.php");
} else {
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Movie</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Cinemark</h1>
        <a href="movie-list.php">Home</a>
    </div>

    <div class="container">
        <h1>Update Movie</h1>
        <form method="POST" action="movie-update.php">
            <input type="hidden" name="id" value="<?= $movie['id'] ?>">
            <label>Title:</label>
            <input type="text" name="title" value="<?= $movie['title'] ?>" required><br>
            <label>Director:</label>
            <input type="text" name="director" value="<?= $movie['director'] ?>"><br>
            <label>Release Year:</label>
            <input type="number" name="release_year" value="<?= $movie['release_year'] ?>"><br>
            <label>Genre:</label>
            <input type="text" name="genre" value="<?= $movie['genre'] ?>"><br>
            <button type="submit">Update Movie</button>
        </form>
    </div>

</body>
</html>