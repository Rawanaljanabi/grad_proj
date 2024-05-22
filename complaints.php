<?php
require_once 'db.php'; // Ensure the database connection is made
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="complaints.css">
    <title>Complaints</title>
    <style>
        /* Add your custom styles here */
      
        .send-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .send-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <button onclick="location.href='complaints_history.php'" id="History" type="button" class="buttons">Complaints History</button>
        </ul>
    </aside>

    <!-- Top bar -->
    <header class="topbar">
        <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li>
                <a href="HomePage.php" class="home-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="complaints.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </a>
            </li>
            <li> 
                <a href="notifications.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                    </svg>
                </a>
            </li>
            <li>
                <button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button>
            </li>
        </ul>
    </header>

    <!-- Main content -->
    <div class="container">
        <div class="complaints-content">
            <!-- Form for submitting complaints -->
            <form id="complaintForm">
                <textarea id="subject" name="subject" placeholder="Subject"></textarea>
                <textarea id="myTextArea" name="complaint" placeholder="Type here..."></textarea>
                <button type="submit" class="send-button">Send</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userEmail;

            // Function to fetch session data
            function getSessionData() {
                return fetch('getSessionData.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch session data: Server responded with ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.email) {
                            userEmail = data.email; // Store email globally
                        } else {
                            throw new Error('Email not found in session');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert(error.message);
                        return Promise.reject(error); // Propagate the error to prevent further execution
                    });
            }

            var complaintForm = document.getElementById('complaintForm');
            if (complaintForm) {
                complaintForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    if (!userEmail) {
                        alert("User email not available. Please ensure you're logged in.");
                        return;
                    }
                    const subjectText = document.getElementById('subject').value;
                    const complaintText = document.getElementById('myTextArea').value;
                    if (!subjectText.trim()) {
                        alert("Please enter a subject before submitting.");
                        return;
                    }
                    if (!complaintText.trim()) {
                        alert("Please enter a complaint before submitting.");
                        return;
                    }

                    const formData = new FormData();
                    formData.append('subject', subjectText);
                    formData.append('complaint', complaintText);
                    formData.append('email', userEmail); // Use the stored email

                    fetch('submit_complaint.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to submit complaint: Server responded with ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Complaint saved successfully!');
                            document.getElementById('subject').value = ''; // Clear the subject field
                            document.getElementById('myTextArea').value = ''; // Clear the textarea
                        } else {
                            throw new Error('Error saving complaint: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert(error.message);
                    });
                });
            }

            // Load session data on initial load
            getSessionData();
        });
         
    document.addEventListener("DOMContentLoaded", function() {
        var defaultGreeting = "complaints";
        var greetingElement = document.getElementById("greeting");

        greetingElement.textContent = defaultGreeting;
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        var logoutButton = document.getElementById("logoutButton");
        logoutButton.addEventListener("click", function() {
            var confirmation = confirm("Are you sure you want to log out?");
            if (confirmation) {
                window.location.href = "login1.php";
            }
        });
    });
    </script>
</body>
</html>
