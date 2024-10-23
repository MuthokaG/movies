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

$stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: movie-list.php");
?>
