<style>
    table {
        border: 3px solid black;
        width: 35%;
        border-radius: 3px;
    }
    td {
        height: 40px;
        padding-left: 15px;
    }
    p {
        font-family: Arial, serif;
        font-size: 15px;
        padding-left: 20px;
        color: red;
    }
    button {
        background-color: #b3e6ff;
        border: none;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        font-family: "Arial", serif;
        border-radius: 3px;
    }
    button:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
</style>

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

$button_name = $_POST["add"];

$name = $_POST["name"];
$genre = $_POST["genre"];
$studio = $_POST["studio"];
$rating = $_POST["rating"];
$release_year = $_POST["ryear"];

$get_single_movie = "SELECT * from Movies WHERE MovieName = '$name' LIMIT 1";

if ($button_name == 'add-movie') {
    $movie_exists = mysqli_query($conn, $get_single_movie);
    if (mysqli_num_rows($movie_exists) == 1) {
        echo "<br><p><strong>$name already exists in the movie list.</strong><br>";
        listMovies($conn);
        return;
    }

    if (!$name or !$genre or !$studio or !$rating or !$release_year) {
        echo "<br><p><strong>All fields are required to add a new movie.</strong><br>";
    } else if (mysqli_num_rows($movie_exists) == 1) {
        echo "<br><p><strong>$name already exists in the movie list.</strong><br>";
    } else {
        $insert_sql = "INSERT INTO Movies (MovieName, Genre, LeadStudio, AudienceRating, ReleaseYear) VALUES ('$name', '$genre', '$studio', $rating, $release_year)";
        $insert_movie = mysqli_query($conn, $insert_sql);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<br><p style='color: black'><strong>$name has been added.</strong><br>";
        } else if (mysqli_error($conn)) {
            echo "<br><p><strong>Error inserting movie: " . mysqli_error($conn) . "</strong><br>";
        } else {
            echo "<br><p><strong>Error: " . $insert_sql . "<strong>" . mysqli_error($conn);
        }
    }
} else {
    // button must be an update
    if ($name and (!$genre and !$studio and !$rating and !$release_year)) {
        echo "<br><p><strong>Genre, Studio, Rating, and/or Release Year are required to update a movie.</strong><br>";
   } else if (!$name) {
        echo "<br><p><strong>Name is a required field to update a movie.</strong><br>";
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
                    echo "<br><p style='color: black'><strong>$name has been updated.</strong><br>";
                } else if (mysqli_error($conn)) {
                    echo "<br><p><strong>Error updating movie: " . mysqli_error($conn) . "</strong><br>";
                } else {
                    echo "<br><p><strong>Error: " . $update_sql . mysqli_error($conn);
                }
            }
        } else {
            echo "<br><p><strong>$name does not exist in the movie list.</strong><br>";
        }
    }
}
listMovies($conn);

$conn->close();
