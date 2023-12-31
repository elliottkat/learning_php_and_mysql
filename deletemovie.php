<?php
require __DIR__ . '/functions.php';

$server = "localhost";
$user = "movieuser";
$password = "movieuserpw";
$dbname = "moviedb";

$conn = mysqli_connect($server, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST["name"];

if (!$name) {
    echo "<br><p style='font-family: Arial, serif; font-size: 15px; padding-left: 20px; padding-top: 20px'><strong>Name is required in order to delete a movie.</strong><br>";
} else {
    $delete_sql = "DELETE FROM Movies WHERE MovieName = '$name'";
    if (mysqli_query($conn, $delete_sql) && mysqli_affected_rows($conn) > 0) {
        echo "<p style='font-family: Arial, serif; font-size: 15px; padding-left: 20px; padding-top: 20px'><strong>$name has been deleted.</strong><br>";
    } else if (mysqli_error($conn)) {
        echo "Error deleting movie: " . mysqli_error($conn);
    } else {
        echo "<p style='font-family: Arial, serif; font-size: 15px; padding-left: 20px; padding-top: 20px'><strong>$name does not exist in the list of movies.</strong><br>";
    }
}

listMovies($conn);

$conn->close();
