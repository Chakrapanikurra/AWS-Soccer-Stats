function fetchPlayerData() {
    // Get the selected player ID
    var selectedPlayerID = document.getElementById("playerSelect").value;

    // Call the getData function with the selected PlayerID
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Display the data in the playerDataContainer
            document.getElementById("playerDataContainer").innerHTML = xhr.responseText;
          
            //update Chart
            updateChart(selectedPlayerID);

        }

    };
    xhr.open("GET", "getData.php?playerID=" + selectedPlayerID, true);
    xhr.send();
}

function updateChart(selectedPlayerID) {
  // Make an AJAX request to get player-specific data
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Parse the JSON response
          var responseData = JSON.parse(xhr.responseText);

          // Extract data for the chart
          var goalsData = responseData.goalsData; 

          // Chart configuration
          const ctx = document.getElementById('myChart');
          var myChart = new Chart(ctx, {
              type: "line",
              data: {
                  labels: responseData.months,
                  datasets: [
                      {
                          label: "Goals Scored",
                          data: goalsData,
                      },
                  ],
              },
          });
      }
  };
  xhr.open("GET", "getPlayerStats.php?playerID=" + selectedPlayerID, true);
  xhr.send();
}


//function to add new player 
function addNewProject(){
    // Serialize the form data
    let formValues = $("#addProjectForm").serialize();
    // Log the serialized data to the console
    console.log(formValues);

    
    url = 'addProject.php';

    $.post(url, formValues, function(data){
        $(addProjectModal).modal('hide');
        location.reload();
    });
}
//function to show the add player modal
function addProject(){
  $('#addProjectModal').modal('show');
}

function showProjects(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Display the data in the playerDataContainer
            document.getElementById("projectDataContainer").innerHTML = xhr.responseText;
          
            //update Chart
            // updateChart(selectedPlayerID);

        }

    };
    xhr.open("GET", "getProjects.php", true);
    xhr.send();
}

$(document).ready(function(){
    showProjects()
    document.querySelector('#addProject').addEventListener('click',addProject);
    // Event listener for the "Save" button click
    document.getElementById('addProjectModalButton').addEventListener('click', addNewProject);

    

    
    

});

