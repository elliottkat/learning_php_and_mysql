<?php

function listMovies($conn) {
    // Get the list of all movies
    $get_sql = "SELECT MovieId, MovieName, Genre, LeadStudio, AudienceRating, ReleaseYear FROM Movies";
    $result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<strong><br>MOVIE LIST:</strong><br><br>";
        echo "<table border=2 class='styled-table'><tr><th>Movie Name</th><th>Genre</th><th>Lead Studio</th><th>Rating</th><th>Year</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='active-row'><td>" . $row["MovieName"] . "</td><td>" . $row["Genre"] . "</td><td>" . $row["LeadStudio"] . "</td><td>" . $row["AudienceRating"] . "</td><td>" . $row["ReleaseYear"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br><strong>There are no movies to show. Try adding one.</strong><br>";
    }

    echo "<br><button onclick='history.back()'>Back</button>";
}

