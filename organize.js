document.addEventListener("DOMContentLoaded", function() {
        // Set default greeting
        var defaultGreeting = "Organize Blood Donation Appointments";
        document.getElementById("greeting").textContent = defaultGreeting;

        // Handle log out
        document.getElementById("logoutButton").addEventListener("click", function() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "page2.html"; // Make sure this is the correct redirection link
            }
        });
    });
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
    
        // Fetch values from the form
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;
        var institute = document.getElementById('institute').value;
        var bloodType = document.getElementById('blood-type').value;
    
        // Basic validation example
        if (!startDate || !endDate || !startTime || !endTime || !institute) {
            alert('Please fill all required fields.');
            return; // Stop the function if validation fails
        }
    
        // Optionally, compare dates and times to ensure logical correctness
        if (new Date(startDate) > new Date(endDate)) {
            alert('End date must be after start date.');
            return;
        }
    
        if (startTime >= endTime) {
            alert('End time must be after start time.');
            return;
        }
    
        // If validation passes, submit the form
        document.querySelector('form').submit();
    });