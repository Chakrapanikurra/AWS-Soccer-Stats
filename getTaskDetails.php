<?php
include 'config/database.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];


    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch project details
    $sql = "SELECT * FROM tasks WHERE task_id = $task_id";
    $task_results = $conn->query($sql);

    // Check if project data is available
    if ($task_results->num_rows > 0) {
        $task_row = $task_results->fetch_assoc();
        echo '
        <div class="project-details">
            <h1>' . $task_row['task_name'] . '</h1>
        </div>';

        // SQL query to fetch tasks associated with the project
        $expenses_sql = "SELECT * FROM expenses WHERE task_id = $task_id";
        $expenses_result = $conn->query($expenses_sql);

        // Check if task data is available
        if ($expenses_result->num_rows > 0) {
            echo '<h2>Expenses</h2> 
            <div class="task-details">';
            while ($expenses_row = $expenses_result->fetch_assoc()) {
                echo '<div class="task-card">
                <link rel="stylesheet" href="style.css">

                        <h3>' . $expenses_row['expense_name'] . '</h3>
                        <p><strong>Description:</strong> ' . $expenses_row['expense_amount'] . '</p>
                        <p><strong>Cost:</strong> $' . $expenses_row['expense_date'] . '</p>
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
