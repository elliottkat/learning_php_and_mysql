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

$name = $_POST["Name"];

if (!$name) {
    echo "<br><strong>Name is required in order to delete a movie.</strong><br>";
} else {
    $select_sql = "SELECT * FROM Movies WHERE MovieName = '$name'";

    // Run the query to get the movie and then delete it
    $select_result = mysqli_query($conn, $select_sql);
    if (mysqli_num_rows($select_result) > 0) {
        $delete_sql = "DELETE FROM Movies WHERE MovieName = '$name'";
        mysqli_query($conn, $delete_sql);
        echo "<br><strong>$name has been deleted.</strong><br>";
    } else {
        echo "<br><strong>$name does not exist in the list of movies.</strong><br>";
    }
}

listMovies($conn);

$conn->close();
