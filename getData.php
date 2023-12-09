<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
// Include or require the functions.php file
include 'config/database.php';

// Get the selected player ID from the query parameters
$playerID = $_GET['playerID'];

// Call the getData function with the selected PlayerID
$result = getData($playerID);

// Display the data
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <div class="player_cards">
        <div class="player-info">
            <input type="hidden" id="Player_ID" name="Player_ID" value="' . $row['Player_ID'] . '">
            <h2>' . $row['Player_Name'] . '</h2>
            <p><strong>Age:</strong> ' . $row['Player_Age'] . '</p>
            <p><strong>Birthplace:</strong> ' . $row['Player_BirthPlace'] . '</p>
            <p><strong>Height:</strong> ' . $row['Player_Height'] . '</p>
            <p><strong>Position:</strong> ' . $row['Player_Position'] . '</p>
            <p><strong>Current Team:</strong> ' . $row['Player_CurrentTeam'] . '</p>
            <p><strong>Games Played:</strong> ' . $row['Player_GamesPlayed'] . '</p>
            <p><strong>Career Goals:</strong> ' . $row['Player_CareerGoals'] . '</p>
        </div>
        <div>
            <h2> Player highlights </h2>
            <canvas id="myChart"></canvas>
        </div>
    </div>';
}

function getData($PlayerID){
    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to select data
    $sql = "SELECT * FROM Soccer_stats WHERE Player_ID = $PlayerID";
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Close the connection
    mysqli_close($conn);

    // Return the result or do something with it
    return $result;
}

?>