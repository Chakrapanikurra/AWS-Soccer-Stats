<?php 
// Include or require the functions.php file
include 'config/database.php';

// Establish a connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// var_dump($_POST['projectName']);

// Get values from the POST request
$projectName = $_POST['projectName'];
$projectDescription = $_POST['projectDescription'];
$totalBudget = $_POST['total_budget'];
$projectStartDate = $_POST['projectStartDate'];
$projectEndDate = $_POST['projectEndDate'];

// SQL query to insert data
$sql = "INSERT INTO projects (project_name, project_description, total_budget, project_start_date, project_end_date)
        VALUES ('$projectName', '$projectDescription','$totalBudget','$projectStartDate', '$projectEndDate')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
