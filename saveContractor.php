<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $contractor_id = $_POST['contractor_id'];
    $contractor_cost = $_POST['contractor_cost'];

    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the contractor selection into a new table (adjust table name as needed)
    $insert_sql = "INSERT INTO project_task_contractor (project_id, task_id, contractor_id) VALUES ($project_id, $task_id, $contractor_id)";
    if ($conn->query($insert_sql) === TRUE) {
        // Update the total budget in the projects table
        $update_sql = "UPDATE projects SET total_budget = total_budget - $contractor_cost WHERE project_id = $project_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "Selection saved successfully and budget updated!";
        } else {
            echo "Error updating budget: " . $conn->error;
        }
    } else {
        echo "Error saving selection: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
