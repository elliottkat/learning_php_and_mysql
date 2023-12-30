<?php
require __DIR__ . '/functions.php';

$server = "localhost";
$user = "movieuser";
$password = "movieuserdb";
$dbname = "moviedb";

$conn = mysqli_connect($server, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$button_name = $_POST["add"];

$name = $_POST["Name"];
$genre = $_POST["Genre"];
$studio = $_POST["Studio"];
$rating = $_POST["Rating"];
$release_year = $_POST["ReleaseYear"];

$get_single_movie = "SELECT MovieId from Movies WHERE MovieName = '$name' LIMIT 1";

if ($button_name == 'add-movie') {
    $movie_exists = mysqli_query($conn, $get_single_movie);
    if (mysqli_num_rows($movie_exists) == 1) {
        echo "<br><strong>$name already exists in the movie list.</strong><br>";
        listMovies($conn);
        return;
    }

    if (!$name or !$genre or !$studio or !$rating or !$release_year) {
        echo "<br><strong>All fields are required to add a new movie.</strong><br>";
    } else if (mysqli_num_rows($movie_exists) == 1) {
        echo "<br><strong>$name already exists in the movie list.</strong><br>";
    } else {
        $insert_sql = "INSERT INTO Movies (MovieName, Genre, LeadStudio, AudienceRating, ReleaseYear) VALUES ('$name', '$genre', '$studio', $rating, $release_year)";
        $insert_movie = mysqli_query($conn, $insert_sql);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<br><strong>$name has been added.</strong><br>";
        } else if (mysqli_error($conn)) {
            echo "<br><strong>Error inserting movie: " . mysqli_error($conn) . "</strong><br>";
        } else {
            echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
        }
    }
} else {
    // button must be an update
    if ($name and (!$genre and !$studio and !$rating and !$release_year)) {
        echo "<br><strong>Genre, Studio, Rating, and/or Release Year are required to update a movie.</strong><br>";
   } else if (!$name) {
        echo "<br><strong>Name is a required field to update a movie.</strong><br>";
    } else {
        $result = mysqli_query($conn, $get_single_movie);
        if (mysqli_affected_rows($conn) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $genre = $genre ?: $row["Genre"];
                $studio = $studio ?: $row["LeadStudio"];
                $rating = $rating ?: $row["AudienceRating"];
                $release_year = $release_year ?: $row["ReleaseYear"];
                $update_sql = "UPDATE Movies SET Genre='$genre', LeadStudio='$studio', AudienceRating='$rating', ReleaseYear='$release_year' WHERE MovieName = '$name'";
                if (mysqli_query($conn, $update_sql)) {
                    echo "<br><strong>$name has been updated.</strong><br>";
                } else if (mysqli_error($conn)) {
                    echo "<br><strong>Error updating movie: " . mysqli_error($conn) . "</strong><br>";
                } else {
                    echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
}
listMovies($conn);

$conn->close();
