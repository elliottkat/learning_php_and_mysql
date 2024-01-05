<style>
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

function listMovies($conn) {
    $get_sql = "SELECT id, name, genre, studio, audience_rating, release_year FROM movies";
    $result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='font-family: Arial, serif; font-size: 15px; padding: 20px'>";
        echo "<table style='border: 3px solid black; width: 35%; border-radius: 3px'><tr style='align-content: center; background-color: #b3e6ff'>
                <th height='50px'>Movie Name</th><th>genre</th><th>Studio</th><th>Rating</th><th>Year</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td height='40px' style='padding-left: 15px'>" . $row["name"] .
                "</td><td style='padding-left: 15px'>" . $row["genre"] . "</td><td style='padding-left: 15px'>" .
                $row["studio"] . "</td><td style='padding-left: 15px'>" . $row["audience_rating"] .
                "</td><td style='padding-left: 15px'>" . $row["release_year"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br><strong>There are no movies to show. Try adding one.</strong><br>";
    }

    echo "<br>
        <button onclick='history.back()'>
            Back
        </button>";
}

