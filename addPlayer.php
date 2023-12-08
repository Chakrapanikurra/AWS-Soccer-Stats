<?php 
// Include or require the functions.php file
include 'config/database.php';

// Establish a connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get values from the POST request
$playerName = $_POST['playerName'];
$age = $_POST['age'];
$birthplace = $_POST['birthplace'];
$height = $_POST['height'];
$position = $_POST['position'];
$currentTeam = $_POST['currentTeam'];
$gamesPlayed = $_POST['gamesPlayed'];
$careerGoals = $_POST['careerGoals'];

// SQL query to insert data
$sql = "INSERT INTO Soccer_stats (Player_Name, Player_Age, Player_BirthPlace, Player_Height, Player_Position, Player_CurrentTeam, Player_GamesPlayed, Player_CareerGoals)
        VALUES ('$playerName', '$age', '$birthplace', '$height', '$position', '$currentTeam', '$gamesPlayed', '$careerGoals')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();


?>
