<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
// Include or require the functions.php file
include 'config/database.php';

// // Get the selected player ID from the query parameters
// $playerID = $_GET['playerID'];

// Call the getData function with the selected PlayerID
$result = getProjects();

// Display the data
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <a style="text-decoration: none" href="getProjectTasks.php?project_id=' . $row['project_id'] . '" class="project_card_link">
        <div class="project_cards">
            <div class="project-info">
                <h2>' . $row['project_name'] . '</h2>
                <p><strong>Description:</strong> ' . $row['project_description'] . '</p>
                <p><strong>Start Date:</strong> ' . $row['project_start_date'] . '</p>
                <p><strong>End Date:</strong> ' . $row['project_end_date'] . '</p>
            </div>
        </div>
    </a>';
}


function getProjects(){
    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to select data
    $sql = "SELECT * FROM projects";
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