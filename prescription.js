document.addEventListener("DOMContentLoaded", function() {
    // Set the default greeting
    var defaultGreeting = "Prescription";
    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;

    // Setup the logout button
    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login.html";
        }
    });
});

function validateAndSubmit() {
    // Corrected IDs and variable names to match the HTML
    var nameValue = document.getElementById("name2").value.trim();
    var ageValue = document.getElementById("age").value.trim();
    var conditionValue = document.getElementById("condition2").value.trim();
    var medicinesNameValue = document.getElementById("medicinesname").value.trim();
    var medicinesDescriptionValue = document.getElementById("medicinesdescription").value.trim();
    var doseValue = document.getElementById("dose").value.trim();
    var notesValue = document.getElementById("notes").value.trim();

    // Check if any of the text boxes are empty
    if (nameValue === "" || ageValue === "" || conditionValue === "" || medicinesNameValue === "" || medicinesDescriptionValue === "" || doseValue === "" || notesValue === "") {
        // Display an alert message if fields are empty
        alert("Please fill in all the text boxes.");
    } else {
        // Display success message if all fields are filled
        alert("Form submitted successfully!");
    }
}
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var fileNumber = urlParams.get('fileNumber');
    if (fileNumber) {
        loadPatientDetails(fileNumber);
    }

    function loadPatientDetails(fileNumber) {
        $.ajax({
            url: 'prescription.php',
            type: 'POST',
            data: {fileNumber: fileNumber},
            success: function(response) {
                var data = JSON.parse(response);
                $('#patientName').text(data.full_name);
                $('#patientAge').text(data.age);
            },
            error: function() {
                alert('Failed to fetch details');
            }
        });
    }
});
function fetchPatientDetails() {
    var fileNumber = $('#patientFileNumber').val();
    $.ajax({
        url: 'fetch_patient_details.php', // Path to your PHP file
        type: 'POST',
        data: {fileNumber: fileNumber},
        success: function(response) {
            var data = JSON.parse(response);
            if(data.success) {
                $('#name2').val(data.name); // Assuming 'name' is the key in the returned object
                $('#age').val(data.age);    // Assuming 'age' is calculated in the PHP script
            } else {
                alert('No patient found with that file number.');
            }
        },
        error: function() {
            alert('Error fetching patient data.');
        }
    });
}
