
//function to add new project 
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

