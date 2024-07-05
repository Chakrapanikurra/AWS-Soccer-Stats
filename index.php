<?php include 'config/database.php'; ?>
<?php
// Function to get all player IDs from the database
function getAllPlayers($conn) {
    $sql = "SELECT Player_ID, Player_Name FROM Soccer_stats";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $players = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $players[] = $row;
    }

    return $players;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Construction Cost Optimiser</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
      
        /* Custom padding for all form groups */
        .form-group {
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>

<body>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Construction Cost Optimiser</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>

    <body class="container">

        <h1 class="mt-4">Construction Cost Optimiser</h1>

        <div class="mb-3">
            <button id="addProject" class="btn btn-primary">Add a Project</button>
        </div>
        <h2> All Projects </h2>
        <!-- <div class="form-group">
            <label for="playerSelect">Select Project:</label>
            <select id="playerSelect" class="form-control" onchange="fetchPlayerData()">
            <?php
        // Get all player IDs and names
        $players = getAllPlayers($conn);
        echo '<option value="0">Choose One</option>';
        foreach ($players as $player) {
            echo "<option value=\"{$player['Player_ID']}\">{$player['Player_Name']}</option>";
        }
        ?>
            </select>
        </div> -->

        <div id="projectDataContainer" class="mt-4">
            <!-- Player data will be displayed here -->
        </div>
        <div>
    <!-- <canvas id="myChart"></canvas>
       </div> -->
        

<!-- Add project modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addProjectForm">
                <div style="color: red" id="error-display"></div>
                <input type="hidden" class="form-control" id="project_id" name="project_id" value=""> 
                <div class="form-group">
                    <label for="projectName">Project Name:</label>
                    <input type="text" class="form-control" id="projectName" name="projectName" placeholder="">
                </div>
                <div class="form-group">
                    <label for="projectDescription">Project Description:</label>
                    <textarea class="form-control" id="projectDescription" name="projectDescription" placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label for="projectStartDate">Start Date:</label>
                    <input type="date" class="form-control" id="projectStartDate" name="projectStartDate">
                </div>
                <div class="form-group">
                    <label for="projectEndDate">End Date:</label>
                    <input type="date" class="form-control" id="projectEndDate" name="projectEndDate">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="CanceladdProjectModalButton" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addProjectModalButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


        <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="functions.js"></script>

        <!-- <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script> -->

    </body>

    </html>