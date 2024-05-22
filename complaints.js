document.addEventListener("DOMContentLoaded", function() {
    var greetingElement = document.getElementById("greeting");
    var logoutButton = document.getElementById("logoutButton");
    var complaintForm = document.getElementById('complaintForm');

    // Set default greeting
    greetingElement.textContent = "Complaints";

    // Confirm logout
    logoutButton.addEventListener("click", function() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "login1.php";
        }
    });

    // Handle form submission
    if (complaintForm) {
        complaintForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const complaint = document.getElementById('myTextArea').value;

            // Send complaint data to the server
            fetch('submit_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}&complaint=${encodeURIComponent(complaint)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Complaint saved successfully!');
                    document.getElementById('myTextArea').value = ''; // Clear the textarea after successful submission
                } else {
                    alert('Error saving complaint.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving complaint. Please try again.');
            });
        });
    } else {
        console.error('Complaint form not found. Ensure the HTML structure is correct.');
    }
});
