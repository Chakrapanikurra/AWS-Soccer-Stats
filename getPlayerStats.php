<?php
// Include or require the functions.php file
include 'config/database.php';
// Establish a connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$playerID = $_GET['playerID'];

// Perform a database query to get player-specific data
$query = "SELECT `Nov2023_Goals`, `Dec2023_Goals`, `Jan2023_Goals`  
FROM `Player_Stats` WHERE `Player_ID` = $playerID";
$result = mysqli_query($conn, $query);

$data = array();
$months = array("November", "December","January");


while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['Nov2023_Goals'];
    $data[] = $row['Dec2023_Goals'];
    $data[] = $row['Jan2023_Goals'];
}

$response = array(
    'months' => $months,
    'goalsData' => $data,
);


header('Content-Type: application/json');
echo json_encode($response);
?>
