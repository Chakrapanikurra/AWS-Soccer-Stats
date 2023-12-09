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
    <title>Soccer Player Info</title>
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
        <title>Soccer Player Info</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>

    <body class="container">

        <h1 class="mt-4">Player Data</h1>

        <div class="mb-3">
            <button id="addPlayer" class="btn btn-primary">Add a Player</button>
        </div>

        <div class="form-group">
            <label for="playerSelect">Select Player:</label>
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
        </div>

        <div id="playerDataContainer" class="mt-4">
            <!-- Player data will be displayed here -->
        </div>
        <div>
    <!-- <canvas id="myChart"></canvas>
       </div> -->
        

        <!-- Add player modal -->
        <div class="modal fade" id="addPlayerModal" tabindex="-1" role="dialog" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custom-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlayerModalLabel">Add Player</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addPlayerForm">
                    <div style="color: red" id="error-display"></div>
                    <input type="hidden" class="form-control" id="player_Id" name="player_Id" value = ""> </input>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="playerName">Player Name:</label>
                                <input type="text" class="form-control" id="playerName" name="playerName" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" class="form-control" id="position" name="position" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="currentTeam">Current Team:</label>
                                <input type="text" class="form-control" id="currentTeam" name="currentTeam" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="gamesPlayed">Games Played:</label>
                                <input type="text" class="form-control" id="gamesPlayed" name="gamesPlayed" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="birthplace">Birthplace:</label>
                                <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="height">Height:</label>
                                <input type="text" class="form-control" id="height" name="height" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="careerGoals">Career Goals:</label>
                                <input type="text" class="form-control" id="careerGoals" name="careerGoals" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="CanceladdPlayerModalButton" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="addPlayerModalButton">Save</button>
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