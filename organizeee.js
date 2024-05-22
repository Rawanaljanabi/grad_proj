    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevents the default form submission

        var datetime = document.getElementById('datetime').value;
        var bloodType = document.getElementById('blood-type').value;
        var institute = document.getElementById('institute').value;

        if (datetime === "" || bloodType === "" || institute === "") {
            alert("Please fill all fields."); // Using alert for empty field notification
        } else {
            alert("Form submitted successfully."); // Using alert for successful submission notification
        }
    });

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
