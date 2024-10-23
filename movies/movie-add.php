<?php
$hn = 'localhost';
$db = 'movie';
$un = 'root';
$pw = '';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];

    $stmt = $conn->prepare("INSERT INTO movies (title, director, release_year, genre) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $director, $release_year, $genre);
    $stmt->execute();

    header("Location: movie-list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <h1>Cinemark</h1>
        <a href="movie-list.php">Home</a>
    </div>

    <div class="container">
        <h1>Add Movie</h1>
        <form method="POST" action="movie-add.php">
            <label>Title:</label>
            <input type="text" name="title" required><br>
            <label>Director:</label>
            <input type="text" name="director"><br>
            <label>Release Year:</label>
            <input type="number" name="release_year"><br>
            <label>Genre:</label>
            <input type="text" name="genre"><br>
            <button type="submit">Add Movie</button>
        </form>
    </div>

</body>
</html>