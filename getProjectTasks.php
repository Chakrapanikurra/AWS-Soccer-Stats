<?php
include 'config/database.php';
// Start the session
session_start();


if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $_SESSION['project_id'] = $project_id;

    // var_dump($_SESSION['project_id']);

    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch project details
    $sql = "SELECT * FROM projects WHERE project_id = $project_id";
    $project_result = $conn->query($sql);

    // Check if project data is available
    if ($project_result->num_rows > 0) {
        $project_row = $project_result->fetch_assoc();
        echo '
        <div class="project-details">
            <h1>' . $project_row['project_name'] . '</h1>
            <h2> Total Project Budget:$' . number_format($project_row['total_budget'], 2). '</h2>
        </div>';

        // SQL query to fetch tasks associated with the project
        $task_sql = "SELECT * FROM tasks WHERE project_id = $project_id";
        $task_result = $conn->query($task_sql);

        // Check if task data is available
        if ($task_result->num_rows > 0) {
            echo '
            <div class="task-details">
            <h2>Tasks</h2> ';
            while ($task_row = $task_result->fetch_assoc()) {
                
                echo '<div class="task-card">
                <link rel="stylesheet" href="style.css">
                <a style="text-decoration: none" href="getTaskDetails.php?project_id=' . $project_id . '&task_id=' . $task_row['task_id'] . '" class="project_card_link">
                <h3>' . $task_row['task_name'] . '</h3>
                <p><strong>Description:</strong> ' . $task_row['task_description'] . '</p>
                <p><strong>Cost:</strong> $' . $task_row['task_cost'] . '</p>
                <p><strong>Status:</strong> ' . $task_row['task_status'] . '</p>
                </a>
            </div>';
            }
            echo '</div>';
        } else {
            echo '<p>No tasks found for this project.</p>';
        }
    } else {
        echo "No project found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid project ID.";
}
?>
