document.getElementById('sendButton').addEventListener('click', function() {
    var textAreaContent = document.getElementById('myTextArea').value.trim();

    if (textAreaContent === "") {
        alert("Please fill the field before sending.");
    } else {
        alert("Sending your announcement...");
        // Here you can add code to actually send the content or handle it as needed
    }
});   

    document.addEventListener("DOMContentLoaded", function() {
        // Set default greeting
        var defaultGreeting = "Urgent Donations Announcement";
        document.getElementById("greeting").textContent = defaultGreeting;

        // Handle log out
        document.getElementById("logoutButton").addEventListener("click", function() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "page2.html"; // Make sure this is the correct redirection link
            }
        });
    });
