$(document).ready(function() {
    $('#greeting').text("Patient Record");

    $('#logoutButton').click(function() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "login1.php";
        }
    });

    $('#patientRecordForm').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            patient_file_number: $('#fileNumberInput').val(),
            name: $('#name').val(),
            age: $('#age').val(),
            condition: $('#condition').val(),
            weight: $('#weight').val(),
            height: $('#height').val(),
            blood_type: $('#bloodtype').val(),
            health_status: $('#healthstatus').val()
        };

        console.log("Submitting patient record: ", formData);

        $.ajax({
            url: 'submit_patient_record.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log("Submit response: ", response);
                if (response.success) {
                    alert('Patient Record Saved Successfully!');
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error details: ", xhr.responseText);
                alert('Error saving patient record: ' + error);
            }
        });
    });
});