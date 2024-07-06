<?php
include 'config/database.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $project_id = $_GET['project_id'];

    // Establish a connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to fetch project details 
    $project_sql = "SELECT * FROM projects WHERE project_id = $project_id";
    $project_results = $conn->query($project_sql);

    // SQL query to fetch task details
    $task_sql = "SELECT * FROM tasks WHERE task_id = $task_id";
    $task_results = $conn->query($task_sql);

    // Check if project data is available
    if ($task_results->num_rows > 0 && $project_results->num_rows > 0) {
        $task_row = $task_results->fetch_assoc();
        $project_row = $project_results->fetch_assoc();

        echo '
        <div class="project-details">
            <h1>' . $task_row['task_name'] . '</h1>
            <h2 id="total-budget">Total Project Budget: $' . number_format($project_row['total_budget'], 2) . '</h2>
            <input type="hidden" id="initial-budget" value="' . $project_row['total_budget'] . '">
        </div>';

        // SQL query to fetch contractors associated with the task
        $contractor_sql = "SELECT * FROM Contractor WHERE task_id = $task_id";
        $contractor_result = $conn->query($contractor_sql);

        // Check if contractor data is available
        if ($contractor_result->num_rows > 0) {
            echo '<h2>Contractors</h2>';
            echo '<div class="task-details">';
            echo '<div class="task-card">';
            echo '<link rel="stylesheet" href="style.css">';
            echo '<label for="contractorSelect">Select Contractor:</label>';
            echo '<select id="contractorSelect" class="form-control" onchange="updateBudget()">';

            while ($contractor_row = $contractor_result->fetch_assoc()) {
                echo '<option value="' . $contractor_row['contractor_cost'] . '" data-contractor-id="' . $contractor_row['contractor_id'] . '">' . $contractor_row['contractor_name'] . ' - $' . $contractor_row['contractor_cost'] . '</option>';
            }

            echo '</select>';
            echo '<button class="btn btn-primary mt-3" onclick="saveSelection()">Save</button>';
            echo '</div>'; // End of task-card
            echo '</div>'; // End of task-details
        } else {
            echo '<p>No contractors found for this task.</p>';
        }
    } else {
        echo '<p>Invalid task or project ID.</p>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo '<p>No task ID specified.</p>';
}
?>
<script>
    function updateBudget() {
        // Get the initial total budget
        var initialBudget = parseFloat(document.getElementById('initial-budget').value);
        
        // Get the selected contractor cost
        var contractorSelect = document.getElementById('contractorSelect');
        var selectedCost = parseFloat(contractorSelect.options[contractorSelect.selectedIndex].value);
        
        // Calculate the updated budget
        var updatedBudget = initialBudget - selectedCost;
        
        // Get the total budget element
        var totalBudgetElement = document.getElementById('total-budget');
        
        // Update the total budget text
        totalBudgetElement.innerHTML = 'Total Project Budget: $' + updatedBudget.toFixed(2);
    }

    function saveSelection() {
        // Get the project_id and task_id
        var project_id = <?php echo $project_id; ?>;
        var task_id = <?php echo $task_id; ?>;
        
        // Get the selected contractor_id and contractor cost
        var contractorSelect = document.getElementById('contractorSelect');
        var selectedContractorId = contractorSelect.options[contractorSelect.selectedIndex].getAttribute('data-contractor-id');
        var selectedCost = parseFloat(contractorSelect.options[contractorSelect.selectedIndex].value);
        
        // Send the data to a PHP script using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "saveContractor.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Selection saved successfully!");
                location.reload();
            }
        };
        xhr.send("project_id=" + project_id + "&task_id=" + task_id + "&contractor_id=" + selectedContractorId + "&contractor_cost=" + selectedCost);
    }
</script>
