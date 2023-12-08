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
            updateChart();

        }

    };

    // Make an asynchronous request to your server
    xhr.open("GET", "getData.php?playerID=" + selectedPlayerID, true);
    xhr.send();
}

function updateChart(){

    var stars = [135850, 52122, 148825, 16939, 9763];
    var months = ["November", "December", "January", "Feburary", "March"];

    const ctx = document.getElementById('myChart');            
    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Goals Scored",
            data: stars,
          },
        ],
      },
    });
}

//function to add new player 
function addNewPlayer(){
    // Serialize the form data
    let formValues = $("#addPlayerForm").serialize();
    // Log the serialized data to the console
    console.log(formValues);

    
    url = 'addPlayer.php';

    $.post(url, formValues, function(data){
        $(addPlayerModal).modal('hide');
        location.reload();
    });
}
//function to show the add player modal
function addPlayer(){
  $('#addPlayerModal').modal('show');
}

$(document).ready(function(){
    
    document.querySelector('#addPlayer').addEventListener('click',addPlayer);
    // Event listener for the "Save" button click
    document.getElementById('addPlayerModalButton').addEventListener('click', addNewPlayer);
    // Event listener for the "Cancel" button click (just to prevent any default behavior)
    document.getElementById('CanceladdPlayerModalButton').addEventListener('click', function(event) {
    event.preventDefault();

    
    

});
});

