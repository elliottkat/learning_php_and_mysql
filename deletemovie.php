<?php
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
        while ($row = mysqli_fetch_assoc($select_result)) {
            $drop_sql = "DELETE FROM Movies WHERE MovieName = '" . $row["MovieName"] . "'";
            mysqli_query($conn, $drop_sql);
            echo "<br><strong>$name has been deleted.</strong><br>";
        }
    } else {
        echo "<br><strong>$name does not exist in the list of movies.</strong><br>";
    }
}

// Set up SQL query that selects data
$get_sql = "SELECT MovieId, MovieName, Genre, LeadStudio, AudienceRating, ReleaseYear FROM Movies";

// Run the query and save the result into $result
$result = mysqli_query($conn, $get_sql);

if (mysqli_num_rows($result) > 0) {
    echo "<strong><br>MOVIE LIST:</strong><br><br>";
    echo "<table border=2><tr><th>Movie Name</th><th>Genre</th><th>Lead Studio</th><th>Rating</th><th>Year</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["MovieName"] . "</td><td>" . $row["Genre"] . "</td><td>" . $row["LeadStudio"] . "</td><td>" . $row["AudienceRating"] . "</td><td>" . $row["ReleaseYear"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<br><strong>There are no movies to show. Try adding one.</strong><br><br>";
}

echo "<br><button onclick='history.back()'>Back</button>";

$conn->close();
